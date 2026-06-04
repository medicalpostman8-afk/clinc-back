<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class RegisteredPatientController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],

            'phone' => [
                'required',
                'string',
                'max:30',
                Rule::unique('users', 'phone'),
            ],

            'email' => [
                'nullable',
                'email',
                Rule::unique('users', 'email'),
            ],

            'password' => ['required', 'string', 'min:6'],

            'gender' => ['nullable', 'in:male,female'],
            'birth_date' => ['nullable', 'date'],
            'weight' => ['nullable', 'numeric'],
            'height' => ['nullable', 'numeric'],
            'chronic_diseases' => ['nullable', 'string'],
            'address' => ['nullable', 'string'],
        ]);

        $user = User::create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'email' => $data['email'] ?? null,
            'password' => Hash::make($data['password']),
        ]);

        Patient::create([
            'user_id' => $user->id,
            'name' => $data['name'],
            'phone' => $data['phone'],
            'email' => $data['email'] ?? null,
            'gender' => $data['gender'] ?? null,
            'birth_date' => $data['birth_date'] ?? null,
            'weight' => $data['weight'] ?? null,
            'height' => $data['height'] ?? null,
            'chronic_diseases' => $data['chronic_diseases'] ?? null,
            'address' => $data['address'] ?? null,
        ]);

        $token = $user->createToken('patient-token')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => [
                'ar' => 'تم إنشاء حساب المريض بنجاح',
                'en' => 'Patient account created successfully',
            ],
            'data' => [
                'token' => $token,
                'user' => new UserResource($user->load('patient')),
            ],
        ], 201);
    }
}
