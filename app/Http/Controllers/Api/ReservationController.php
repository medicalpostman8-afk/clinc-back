<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reservation\StoreReservationRequest;
use App\Http\Requests\Reservation\UpdateReservationStatusRequest;
use App\Http\Resources\ReservationResource;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    private function doctor()
    {
        return auth()->user();
    }

    public function index(Request $request)
    {
        $query = Reservation::with('patient')
            ->where('doctor_id', $this->doctor()->id);

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->search) {
            $query->whereHas('patient', function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%");
            });
        }

        return ReservationResource::collection(
            $query->latest()->paginate(10)
        );
    }

    public function store(StoreReservationRequest $request)
    {
        $doctor = $this->doctor();

        $exists = Reservation::where('doctor_id', $doctor->id)
            ->where('date', $request->date)
            ->where('time', $request->time)
            ->exists();

        if ($exists) {
            return response()->json([
                'status' => false,
                'message' => [
                    'ar' => 'هذا الموعد محجوز بالفعل',
                    'en' => 'This time slot is already booked'
                ]
            ], 422);
        }

        $reservation = Reservation::create([
            ...$request->validated(),
            'doctor_id' => $doctor->id
        ]);

        return response()->json([
            'status' => true,
            'message' => [
                'ar' => 'تم إنشاء الحجز',
                'en' => 'Reservation created successfully'
            ],
            'data' => new ReservationResource($reservation->load('patient'))
        ]);
    }

    public function show(Reservation $reservation)
    {

        return new ReservationResource(
            $reservation->load('patient')
        );
    }

    public function update(Request $request, Reservation $reservation)
    {

        $reservation->update($request->only('date', 'time'));

        return response()->json([
            'status' => true,
            'message' => [
                'ar' => 'تم التحديث',
                'en' => 'Updated successfully'
            ],
            'data' => new ReservationResource($reservation)
        ]);
    }

    public function destroy(Reservation $reservation)
    {

        $reservation->delete();

        return response()->json([
            'status' => true,
            'message' => [
                'ar' => 'تم الإلغاء',
                'en' => 'Cancelled successfully'
            ]
        ]);
    }

    public function updateStatus(UpdateReservationStatusRequest $request, Reservation $reservation)
    {

        $reservation->update([
            'status' => $request->status
        ]);

        return response()->json([
            'status' => true,
            'message' => [
                'ar' => 'تم تحديث الحالة',
                'en' => 'Status updated'
            ],
            'data' => new ReservationResource($reservation)
        ]);
    }
}
