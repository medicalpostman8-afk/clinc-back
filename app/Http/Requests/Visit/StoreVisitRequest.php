<?php

namespace App\Http\Requests\Visit;

use Illuminate\Foundation\Http\FormRequest;

class StoreVisitRequest extends FormRequest
{
    public function rules()
    {
        return [
            'patient_id' => 'required|exists:patients,id',
            'type' => 'required|in:consultation,follow_up,analysis',
            'diagnosis' => 'nullable|string',

            'prescriptions' => 'nullable|array',
            'prescriptions.*.medicine_name' => 'required|string',

            'analysis.*' => 'file|mimes:jpg,png,pdf|max:2048',
            'xray.*' => 'file|mimes:jpg,png,pdf|max:2048',
        ];
    }
}
