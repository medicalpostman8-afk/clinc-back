<?php

namespace App\Http\Requests\Prescription;

use Illuminate\Foundation\Http\FormRequest;

class StorePrescriptionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'patient_id' => 'required|exists:patients,id',
            'medicine_name' => 'required|string',
            'visit_id' => 'required|exists:visits,id',
            'dose' => 'nullable|string',
            'duration' => 'nullable|string',
            'frequency' => 'nullable|string',
            'notes' => 'nullable|string',

            'file' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
        ];
    }
}
