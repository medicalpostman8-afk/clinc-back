<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EmergencyRequestResource;
use App\Models\EmergencyRequest;
use Illuminate\Http\Request;

class EmergencyRequestController extends Controller
{
    public function index(Request $request)
    {
        $requests = EmergencyRequest::query()
            ->where('user_id', $request->user()->id)
            ->latest()
            ->get();

        return EmergencyRequestResource::collection($requests);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'message' => ['nullable', 'string'],
            'latitude' => ['nullable', 'numeric'],
            'longitude' => ['nullable', 'numeric'],
        ]);

        $emergency = EmergencyRequest::create([
            ...$data,
            'user_id' => $request->user()->id,
            'status' => 'pending',
        ]);

        return response()->json([
            'status' => true,
            'message' => [
                'ar' => 'تم إرسال طلب الطوارئ بنجاح',
                'en' => 'Emergency request sent successfully',
            ],
            'data' => new EmergencyRequestResource($emergency),
        ], 201);
    }

    public function show(Request $request, EmergencyRequest $emergencyRequest)
    {
        abort_if($emergencyRequest->user_id !== $request->user()->id, 403);

        return new EmergencyRequestResource($emergencyRequest);
    }

    public function cancel(Request $request, EmergencyRequest $emergencyRequest)
    {
        abort_if($emergencyRequest->user_id !== $request->user()->id, 403);

        $emergencyRequest->update([
            'status' => 'cancelled',
        ]);

        return new EmergencyRequestResource($emergencyRequest);
    }
}
