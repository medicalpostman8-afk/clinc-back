<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reservation\StoreReservationRequest;
use App\Http\Resources\PatientReservationResource;
use App\Models\Reservation;
use Illuminate\Http\Request;

class PatientReservationController extends Controller
{
    public function index(Request $request)
    {
        $reservations = Reservation::query()
            ->with(['doctor'])
            ->where('patient_id', $request->user()->id)
            ->when(
                $request->filled('status'),
                fn($query) => $query->where('status', $request->status)
            )
            ->latest()
            ->get();

        return PatientReservationResource::collection($reservations);
    }

    public function store(Request $request)
    {
        $patientId = $request->user()->patient?->id;

        $data = $request->validate([
            'doctor_id' => ['required', 'exists:users,id'],
            'date' => ['required', 'date'],
            'time' => ['required'],
            'notes' => ['nullable', 'string'],
            'descriptions' => ['nullable', 'string'],
            'type' => ['nullable', 'in:consultation,follow_up,reservation'],
            'price' => ['nullable', 'numeric', 'min:0'],
        ]);

        $exists = Reservation::query()
            ->where('doctor_id', $data['doctor_id'])
            ->whereDate('date', $data['date'])
            ->where('time', $data['time'])
            ->where('status', '!=', 'cancelled')
            ->exists();

        if ($exists) {
            return response()->json([
                'status' => false,
                'message' => [
                    'ar' => 'هذا الموعد محجوز بالفعل',
                    'en' => 'This time slot is already booked',
                ],
            ], 422);
        }

        $reservation = Reservation::create([
            'patient_id' => $patientId,
            'doctor_id' => $data['doctor_id'],
            'date' => $data['date'],
            'time' => $data['time'],
            'notes' => $data['notes'] ?? null,
            'descriptions' => $data['descriptions'] ?? null,
            'type' => $data['type'] ?? 'reservation',
            'price' => $data['price'] ?? 0,
            'status' => 'pending',
        ]);

        return response()->json([
            'status' => true,
            'message' => [
                'ar' => 'تم إنشاء الحجز بنجاح',
                'en' => 'Reservation created successfully',
            ],
            'data' => new PatientReservationResource($reservation->load(['doctor', 'patient'])),
        ], 201);
    }


    public function show(Request $request, Reservation $reservation)
    {
        return new PatientReservationResource(
            $reservation->load('doctor')
        );
    }

    public function cancel(Request $request, Reservation $reservation)
    {
        $reservation->update([
            'status' => 'cancelled',
        ]);

        return response()->json([
            'status' => true,
            'message' => [
                'ar' => 'تم إلغاء الحجز بنجاح',
                'en' => 'Reservation cancelled successfully',
            ],
            'data' => new PatientReservationResource($reservation->load('doctor')),
        ]);
    }

    public function pay(Request $request, Reservation $reservation)
    {
        $patientId = $request->user()->patient?->id;

        $data = $request->validate([
            'payment_method' => ['required', 'in:card,app,cash'],
            'transaction_id' => ['nullable', 'string', 'max:255'],

            'card_number' => ['nullable', 'string', 'max:20'],
            'card_holder_name' => ['nullable', 'string', 'max:255'],
            'expiry_date' => ['nullable', 'string', 'max:10'],
            'cvv' => ['nullable', 'string', 'max:5'],
        ]);

        if (($reservation->payment_status ?? 'unpaid') === 'paid') {
            return response()->json([
                'status' => false,
                'message' => [
                    'ar' => 'تم دفع هذا الحجز من قبل',
                    'en' => 'This reservation is already paid',
                ],
            ]);
        }

        $reservation->update([
            'payment_status' => 'paid',
            'payment_method' => $data['payment_method'],
            'transaction_id' => $data['transaction_id'] ?? 'TXN-' . now()->timestamp . '-' . $reservation->id,
            'paid_at' => now(),
            'status' => 'completed',
        ]);

        return response()->json([
            'status' => true,
            'message' => [
                'ar' => 'تم الدفع بنجاح',
                'en' => 'Payment completed successfully',
            ],
            'data' => new PatientReservationResource(
                $reservation->load(['doctor', 'patient'])
            ),
        ]);
    }
}
