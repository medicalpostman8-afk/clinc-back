<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        $rules = [
            'title' => ['required', 'array'],
            'title.*' => ['required', 'string', 'max:255'],

            'description' => ['required', 'array'],
            'description.*' => ['required', 'string'],

            'image' => ['image', 'mimes:png,jpg,jpeg,webp', 'max:2048'],
        ];

        if ($this->isMethod('post')) {
            $rules['image'][] = 'required';
        } else {
            $rules['image'][] = 'nullable';
        }

        return $rules;
    }
}
