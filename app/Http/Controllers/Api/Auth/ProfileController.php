<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordRequest;
use App\Http\Requests\ProfileRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function update(ProfileRequest $request)
    {
        $user = Auth::user();

        $user->update($request->validated());

        if ($request->image) {
            $user->addMediaFromRequest('image')->toMediaCollection('avatar');
        }

        return new UserResource($user);
    }

    public function update_password(PasswordRequest $request)
    {
        $user = Auth::user();

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return response(null);
    }

    public function delete()
    {
        Auth::user()->delete();

        Auth::guard('web')->logout();

        return response(null);
    }
}
