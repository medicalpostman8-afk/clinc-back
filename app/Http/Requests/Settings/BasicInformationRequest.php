<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;

class BasicInformationRequest extends FormRequest
{
    /**
     * The URI that users should be redirected to if validation fails.
     *
     * @var string
     */
    protected $redirect = '';

    public function __construct()
    {
        $this->redirect = route('dashboard.settings.index', ['tab' => 'basic-information']);
    }

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
        $stringRules = ['required', 'string', 'max:255'];

        return [
            'name.*' => [...$stringRules],
            'description.*' => [...$stringRules],
            'address.*' => [...$stringRules],
            'email' => [...$stringRules, 'email'],
            'phone' => [...$stringRules],
            'keywords.*' => [...$stringRules],
            'logo' => ['nullable', 'image', 'mimes:png,jpg,webp', 'max:2024'],
            'icon' => ['nullable', 'image', 'mimes:png,jpg,webp', 'max:2024'],
        ];
    }
}
