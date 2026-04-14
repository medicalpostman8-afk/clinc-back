<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Patient\StorePatientRequest;
use App\Http\Requests\Patient\UpdatePatientRequest;
use App\Http\Resources\PatientResource;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        $query = Patient::query();

        if ($request->search) {
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
        $patient = Patient::create($request->validated());

        return response()->json([
            'status' => true,
            'message' => [
                'ar' => 'تم إضافة المريض',
                'en' => 'Patient created successfully'
            ],
            'data' => new PatientResource($patient)
        ]);
    }

    public function show(Patient $patient)
    {
        return new PatientResource($patient);
    }

    public function update(UpdatePatientRequest $request, Patient $patient)
    {
        $patient->update($request->validated());

        return response()->json([
            'status' => true,
            'message' => [
                'ar' => 'تم تحديث بيانات المريض',
                'en' => 'Patient updated successfully'
            ],
            'data' => new PatientResource($patient)
        ]);
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();

        return response()->json([
            'status' => true,
            'message' => [
                'ar' => 'تم حذف المريض',
                'en' => 'Patient deleted successfully'
            ]
        ]);
    }
}
