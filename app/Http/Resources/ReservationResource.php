<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'date' => $this->date,
            'time' => $this->time,
            'status' => $this->status,

            'patient_name' => $this->patient->name,
            'patient_phone' => $this->patient->phone,

            'status_label' => match ($this->status) {
                'pending' => 'في الانتظار',
                'completed' => 'المنتهية',
                'cancelled' => 'ملغية',
            },
            'notes' => $this->notes,
            'descriptions' => $this->descriptions,
            'price' => $this->price,
            'type' => $this->type,
            'payment_status' => $this->price ? 'مدفوع' : 'غير مدفوع',
        ];
    }
}
