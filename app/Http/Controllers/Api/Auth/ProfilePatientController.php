<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfilePatientController extends Controller
{
    public function show(Request $request)
    {
        return response()->json([
            'status' => true,
            'message' => [
                'ar' => 'تم جلب الملف الشخصي بنجاح',
                'en' => 'Profile fetched successfully',
            ],
            'data' => new UserResource($request->user()->load('patient')),
        ]);
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $data = $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'phone' => [
                'nullable',
                'string',
                'max:30',
                Rule::unique('users', 'phone')->ignore($user->id),
            ],
            'email' => [
                'nullable',
                'email',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'gender' => ['nullable', 'in:male,female'],
            'birth_date' => ['nullable', 'date'],
            'weight' => ['nullable', 'numeric'],
            'height' => ['nullable', 'numeric'],
            'chronic_diseases' => ['nullable', 'string'],
        ]);

        $user->update([
            'name' => $data['name'] ?? $user->name,
            'phone' => $data['phone'] ?? $user->phone,
            'email' => $data['email'] ?? $user->email,
        ]);

        $user->patient()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'name' => $data['name'] ?? $user->name,
                'phone' => $data['phone'] ?? $user->phone,
                'email' => $data['email'] ?? $user->email,
                'gender' => $data['gender'] ?? $user->patient?->gender,
                'birth_date' => $data['birth_date'] ?? $user->patient?->birth_date,
                'weight' => $data['weight'] ?? $user->patient?->weight,
                'height' => $data['height'] ?? $user->patient?->height,
                'chronic_diseases' => $data['chronic_diseases'] ?? $user->patient?->chronic_diseases,
            ]
        );

        return response()->json([
            'status' => true,
            'message' => [
                'ar' => 'تم تحديث الملف الشخصي بنجاح',
                'en' => 'Profile updated successfully',
            ],
            'data' => new UserResource($user->load('patient')),
        ]);
    }
}
