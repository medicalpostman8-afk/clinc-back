<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Patient\StorePatientPrescriptionRequest;
use App\Http\Resources\PrescriptionResource;
use App\Models\Prescription;
use Illuminate\Http\Request;

class PatientPrescriptionController extends Controller
{
    public function index(Request $request)
    {
        $patientId = $request->user()->patient?->id;

        $prescriptions = Prescription::query()
            ->where('patient_id', $patientId)
            ->latest()
            ->get();

        return PrescriptionResource::collection($prescriptions);
    }

    public function store(StorePatientPrescriptionRequest $request)
    {
        $patientId = $request->user()->patient?->id;

        if (! $patientId) {
            return response()->json([
                'status' => false,
                'message' => [
                    'ar' => 'لا يوجد ملف مريض مرتبط بهذا المستخدم',
                    'en' => 'No patient profile linked to this user',
                ],
            ], 422);
        }

        $prescription = Prescription::create([
            'patient_id' => $patientId,
            'visit_id' => $request->visit_id,
            'reservation_id' => $request->reservation_id,
            'medicine_name' => $request->medicine_name ?? 'روشتة مرفوعة',
            'dosage' => $request->dosage,
            'description' => $request->description,
            'notes' => $request->notes,
        ]);

        if ($request->hasFile('image')) {
            $prescription->addMediaFromRequest('image')
                ->toMediaCollection('image');
        }

        if ($request->hasFile('file')) {
            $prescription->addMediaFromRequest('file')
                ->toMediaCollection('files');
        }

        return response()->json([
            'status' => true,
            'message' => [
                'ar' => 'تم إضافة الروشتة بنجاح',
                'en' => 'Prescription added successfully',
            ],
            'data' => new PrescriptionResource($prescription),
        ], 201);
    }


    public function show(Request $request, Prescription $prescription)
    {
        $patientId = $request->user()->patient?->id;

        abort_if($prescription->patient_id !== $patientId, 403);

        return response()->json([
            'status' => true,
            'message' => [
                'ar' => 'تم جلب تفاصيل الروشتة بنجاح',
                'en' => 'Prescription fetched successfully',
            ],
            'data' => new PrescriptionResource($prescription),
        ]);
    }
}
