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

    private function applyStatusFilter($query, $status)
    {
        if (!$status) {
            return $query;
        }

        $statuses = is_array($status)
            ? $status
            : explode(',', $status);

        $statuses = array_filter(array_map('trim', $statuses));

        if (count($statuses) > 1) {
            $query->whereIn('status', $statuses);
        } elseif (count($statuses) === 1) {
            $query->where('status', $statuses[0]);
        }

        return $query;
    }

    private function applyDateFilter($query, Request $request)
    {
        if ($request->filled('date')) {
            $query->whereDate('date', $request->date);
            return $query;
        }

        if ($request->filled('date_from')) {
            $query->whereDate('date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('date', '<=', $request->date_to);
        }

        return $query;
    }


    private function applyPatientSearchFilter($query, ?string $search)
    {
        if (!$search) {
            return $query;
        }

        $search = trim($search);
        $cleanPhoneSearch = preg_replace('/\s+/', '', $search);

        $patientTable = (new Patient())->getTable();

        $availableColumns = [];

        foreach (['name', 'phone', 'mobile', 'phone_number'] as $column) {
            if (Schema::hasColumn($patientTable, $column)) {
                $availableColumns[] = $column;
            }
        }

        if (empty($availableColumns)) {
            return $query;
        }

        $query->whereHas('patient', function ($q) use ($availableColumns, $search, $cleanPhoneSearch) {
            $q->where(function ($patientQuery) use ($availableColumns, $search, $cleanPhoneSearch) {
                foreach ($availableColumns as $index => $column) {
                    if ($index === 0) {
                        $patientQuery->where($column, 'like', "%{$search}%");
                    } else {
                        $patientQuery->orWhere($column, 'like', "%{$search}%");
                    }

                    if (in_array($column, ['phone', 'mobile', 'phone_number'])) {
                        $patientQuery->orWhereRaw(
                            "REPLACE({$column}, ' ', '') LIKE ?",
                            ["%{$cleanPhoneSearch}%"]
                        );
                    }
                }
            });
        });

        return $query;
    }


    public function index(Request $request)
    {
        $request->validate([
            'status' => 'nullable',
            'date' => 'nullable|date',
            'date_from' => 'nullable|date',
            'date_to' => 'nullable|date|after_or_equal:date_from',
            'search' => 'nullable|string|max:255',
            'per_page' => 'nullable|integer|min:1|max:100',
        ]);

        $query = Reservation::with('patient')
            ->where('doctor_id', $this->doctor()->id);

        $this->applyStatusFilter($query, $request->input('status'));
        $this->applyDateFilter($query, $request);
        $this->applyPatientSearchFilter($query, $request->input('search'));

        $reservations = $query
            ->orderByDesc('date')
            ->orderBy('time')
            ->paginate($request->input('per_page', 10));

        return ReservationResource::collection($reservations);
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
            // 'doctor_id' => $doctor->id,
            'status' => 'pending'
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

    public function dayReservations(Request $request)
    {
        $request->validate([
            'date' => 'required|date'
        ]);

        $doctor = auth()->user();

        $reservations = Reservation::with('patient')
            ->where('doctor_id', $doctor->id)
            ->whereDate('date', $request->date)
            ->orderBy('time')
            ->get();

        return response()->json([
            'status' => true,
            'message' => [
                'ar' => 'تم جلب مواعيد اليوم',
                'en' => 'Day reservations fetched successfully'
            ],
            'data' => ReservationResource::collection($reservations)
        ]);
    }
}
