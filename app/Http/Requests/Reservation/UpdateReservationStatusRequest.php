<?php

namespace App\Http\Requests\Reservation;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReservationStatusRequest extends FormRequest
{
    public function rules()
    {
        return [
            'status' => ['required', 'in:pending,completed,cancelled']
        ];
    }
}
