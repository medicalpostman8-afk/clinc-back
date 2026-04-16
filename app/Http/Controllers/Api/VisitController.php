<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Visit\StoreVisitRequest;
use App\Http\Resources\VisitResource;
use App\Models\Visit;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    public function store(StoreVisitRequest $request)
    {
        $visit = Visit::create([
            'patient_id' => $request->patient_id,
            'doctor_id' => auth()->id(),
            'type' => $request->type,
            'diagnosis' => $request->diagnosis,
        ]);

        if ($request->prescriptions) {
            foreach ($request->prescriptions as $item) {
                $visit->prescriptions()->create($item);
            }
        }

        if ($request->hasFile('analysis')) {
            foreach ($request->file('analysis') as $file) {
                $visit->addMedia($file)->toMediaCollection('analysis');
            }
        }

        if ($request->hasFile('xray')) {
            foreach ($request->file('xray') as $file) {
                $visit->addMedia($file)->toMediaCollection('xray');
            }
        }

        return new VisitResource($visit->load('prescriptions'));
    }

    public function patientVisits($patientId)
    {
        return VisitResource::collection(
            Visit::where('patient_id', $patientId)
                ->with('prescriptions')
                ->latest()
                ->get()
        );
    }
}
