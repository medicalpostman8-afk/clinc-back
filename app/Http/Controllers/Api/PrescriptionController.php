<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Prescription\StorePrescriptionRequest;
use App\Models\Prescription;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{

    public function store(StorePrescriptionRequest $request)
    {
        $prescription = Prescription::create([
            ...$request->validated(),
            'doctor_id' => auth()->id(),
        ]);

        if ($request->hasFile('file')) {
            $prescription
                ->addMedia($request->file('file'))
                ->toMediaCollection('files');
        }

        return response()->json([
            'status' => true,
            'message' => 'تم إضافة الروشتة',
            'data' => $prescription
        ]);
    }

    public function patientPrescriptions($patientId)
    {
        return Prescription::where('patient_id', $patientId)
            ->latest()
            ->get();
    }

    public function destroy(Prescription $prescription)
    {
        $prescription->delete();

        return response()->json([
            'status' => true,
            'message' => 'تم الحذف'
        ]);
    }
}
