<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use App\Models\User;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'roles' => __('ui.role')
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' =>  ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'latitude' => ['nullable', 'numeric'],
            'longitude' => ['nullable', 'numeric'],
            'roles' => ['nullable', 'array'],
            'roles.*' => ['string', 'exists:roles,name'],
            'image' => ['image', 'mimes:png,jpg,webp', 'max:2024'],
            'password' => [Password::defaults()],
            'type' => ['nullable', 'in:' . implode(',', User::AVAILABLE_ACCOUNT_TYPES)],
        ];

        if ($this->isMethod('PUT')) {
            // Update model request
            array_push($rules['email'], "unique:users,email,{$this->user->id}");
            array_push($rules['image'], 'nullable');
            array_push($rules['password'], 'nullable');
        } else {
            // Store model request
            array_push($rules['email'], 'unique:users,email');
            array_push($rules['image'], 'required');
            array_push($rules['password'], 'required');
        }

        return $rules;
    }
}
