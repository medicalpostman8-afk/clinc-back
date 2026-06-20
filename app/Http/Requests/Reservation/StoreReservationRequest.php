<?php

namespace App\Http\Requests\Reservation;

use Illuminate\Foundation\Http\FormRequest;

class StoreReservationRequest extends FormRequest
{
    public function rules()
    {
        return [
            'doctor_id' => ['required', 'exists:users,id'],
            'patient_id' => ['required', 'exists:patients,id'],
            'date' => ['required', 'date'],
            'time' => ['required'],
            'notes' => ['nullable', 'string'],
            'descriptions' => ['nullable', 'string'],
            'price' => ['nullable', 'numeric'],
            'type' => ['required', 'in:consultation,follow_up,analysis'],
        ];
    }
}
