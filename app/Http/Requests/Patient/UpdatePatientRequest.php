<?php

namespace App\Http\Requests\Patient;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePatientRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'sometimes|string|max:255',
            'phone' => 'nullable|string|max:20|unique:patients,phone,' . $this->patient->id
        ];
    }
}
