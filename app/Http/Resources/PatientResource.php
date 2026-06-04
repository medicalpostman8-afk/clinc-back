<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'gender' => $this->gender,
            'birth_date' => $this->birth_date?->format('Y-m-d'),
            'weight' => $this->weight,
            'height' => $this->height,
            'chronic_diseases' => $this->chronic_diseases,
            'created_at' => $this->created_at?->format('Y-m-d H:i'),
        ];
    }
}
