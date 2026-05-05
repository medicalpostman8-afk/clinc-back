<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientHistoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'patient' => [
                'id' => $this->id,
                'name' => $this->name,
                'phone' => $this->phone,
            ],

            'reservations' => $this->reservations->map(fn($reservation) => [
                'id' => $reservation->id,
                'doctor' => [
                    'id' => $reservation->doctor?->id,
                    'name' => $reservation->doctor?->name,
                ],
                'date' => $reservation->date,
                'time' => $reservation->time,
                'status' => $reservation->status,
                'type' => $reservation->type,
                'price' => $reservation->price,
                'descriptions' => $reservation->descriptions,
                'notes' => $reservation->notes,
            ]),

            'visits' => $this->visits->map(fn($visit) => [
                'id' => $visit->id,
                'doctor' => [
                    'id' => $visit->doctor?->id,
                    'name' => $visit->doctor?->name,
                ],
                'type' => $visit->type,
                'diagnosis' => $visit->diagnosis,

                'analysis' => $visit->getMedia('analysis')->map(fn($media) => [
                    'id' => $media->id,
                    'url' => $media->getUrl(),
                ]),

                'xray' => $visit->getMedia('xray')->map(fn($media) => [
                    'id' => $media->id,
                    'url' => $media->getUrl(),
                ]),

                'prescriptions' => $visit->prescriptions->map(fn($prescription) => [
                    'id' => $prescription->id,
                    'medicine_name' => $prescription->medicine_name,
                    'dose' => $prescription->dose,
                    'duration' => $prescription->duration,
                    'frequency' => $prescription->frequency,
                    'notes' => $prescription->notes,
                    'files' => $prescription->getMedia('prescription_files')->map(fn($media) => [
                        'id' => $media->id,
                        'url' => $media->getUrl(),
                    ]),
                ]),

                'created_at' => $visit->created_at?->format('Y-m-d H:i'),
            ]),
        ];
    }
}
