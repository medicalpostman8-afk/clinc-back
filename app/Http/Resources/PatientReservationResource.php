<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientReservationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,

            'doctor' => [
                'id' => $this->doctor?->id,
                'name' => $this->doctor?->name,
                'phone' => $this->doctor?->phone,
            ],

            'date' => $this->date,
            'time' => $this->time,

            'status' => [
                'value' => $this->status,
                'label' => match ($this->status) {
                    'pending' => 'في الانتظار',
                    'completed' => 'المنتهية',
                    'cancelled' => 'ملغية',
                    default => $this->status,
                },
            ],

            'notes' => $this->notes,
            'descriptions' => $this->descriptions,
            'price' => $this->price,

            'payment_status' => [
                'value' => $this->price > 0 ? 'paid' : 'unpaid',
                'label' => $this->price > 0 ? 'مدفوع' : 'غير مدفوع',
            ],

            'created_at' => $this->created_at?->format('Y-m-d H:i'),
        ];
    }
}
