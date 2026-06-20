<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Patient\StorePatientRequest;
use App\Http\Requests\Patient\UpdatePatientRequest;
use App\Http\Resources\PatientHistoryResource;
use App\Http\Resources\PatientResource;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        $query = Patient::query()
            ->where('user_id', auth()->id());

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%")
                    ->orWhere('phone', 'like', "%{$request->search}%");
            });
        }

        return PatientResource::collection(
            $query->latest()->paginate(10)
        );
    }

    public function store(StorePatientRequest $request)
    {
        $data = $request->validated();

        $data['user_id'] = auth()->id();

        $patient = Patient::create($data);

        return response()->json([
            'status' => true,
            'message' => [
                'ar' => 'تم إضافة المريض',
                'en' => 'Patient created successfully',
            ],
            'data' => new PatientResource($patient),
        ]);
    }

    public function show(Patient $patient)
    {
        if ($patient->user_id !== auth()->id()) {
            return response()->json([
                'status' => false,
                'message' => [
                    'ar' => 'غير مصرح لك بعرض هذا المريض',
                    'en' => 'You are not authorized to view this patient',
                ],
            ], 403);
        }

        return new PatientResource($patient);
    }

    public function update(UpdatePatientRequest $request, Patient $patient)
    {
        if ($patient->user_id !== auth()->id()) {
            return response()->json([
                'status' => false,
                'message' => [
                    'ar' => 'غير مصرح لك بتعديل هذا المريض',
                    'en' => 'You are not authorized to update this patient',
                ],
            ], 403);
        }

        $patient->update($request->validated());

        return response()->json([
            'status' => true,
            'message' => [
                'ar' => 'تم تحديث بيانات المريض',
                'en' => 'Patient updated successfully',
            ],
            'data' => new PatientResource($patient),
        ]);
    }

    public function destroy(Patient $patient)
    {
        if ($patient->user_id !== auth()->id()) {
            return response()->json([
                'status' => false,
                'message' => [
                    'ar' => 'غير مصرح لك بحذف هذا المريض',
                    'en' => 'You are not authorized to delete this patient',
                ],
            ], 403);
        }

        $patient->delete();

        return response()->json([
            'status' => true,
            'message' => [
                'ar' => 'تم حذف المريض',
                'en' => 'Patient deleted successfully',
            ],
        ]);
    }

    public function history(Patient $patient)
    {
        if ($patient->user_id !== auth()->id()) {
            return response()->json([
                'status' => false,
                'message' => [
                    'ar' => 'غير مصرح لك بعرض سجل هذا المريض',
                    'en' => 'You are not authorized to view this patient history',
                ],
            ], 403);
        }

        $patient->load([
            'reservations.doctor:id,name',
            'visits.doctor:id,name',
            'visits.prescriptions',
        ]);

        return response()->json([
            'status' => true,
            'data' => new PatientHistoryResource($patient),
        ]);
    }
}
