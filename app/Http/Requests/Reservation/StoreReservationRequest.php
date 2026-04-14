<?php

namespace App\Http\Requests\Reservation;

use Illuminate\Foundation\Http\FormRequest;

class StoreReservationRequest extends FormRequest
{
    public function rules()
    {
        return [
            'patient_id' => ['required', 'exists:patients,id'],
            'date' => ['required', 'date'],
            'time' => ['required']
        ];
    }
}
