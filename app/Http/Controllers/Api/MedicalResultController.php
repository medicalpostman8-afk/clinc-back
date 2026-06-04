<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MedicalResultResource;
use App\Models\MedicalResult;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Http\Request;

class MedicalResultController extends Controller
{
    public function index(Request $request)
    {
        $results = MedicalResult::query()
            ->where('user_id', $request->user()->id)
            ->latest()
            ->get();

        return MedicalResultResource::collection($results);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'result_date' => ['nullable', 'date'],
            'files' => ['nullable', 'array'],
            'files.*' => ['file', 'mimes:jpg,jpeg,png,webp,pdf', 'max:5120'],
        ]);

        $result = MedicalResult::create([
            'user_id' => $request->user()->id,
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
            'result_date' => $data['result_date'] ?? null,
        ]);

        foreach ($request->file('files', []) as $file) {
            $result->addMedia($file)->toMediaCollection('files');
        }

        return response()->json([
            'status' => true,
            'message' => [
                'ar' => 'تم إضافة النتيجة الطبية بنجاح',
                'en' => 'Medical result created successfully',
            ],
            'data' => new MedicalResultResource($result),
        ], 201);
    }

    public function show(Request $request, MedicalResult $medicalResult)
    {

        return new MedicalResultResource($medicalResult);
    }

    public function uploadFiles(Request $request, MedicalResult $medicalResult)
    {
        abort_if($medicalResult->user_id !== $request->user()->id, 403);

        $request->validate([
            'files' => ['required', 'array'],
            'files.*' => ['file', 'mimes:jpg,jpeg,png,webp,pdf', 'max:5120'],
        ]);

        foreach ($request->file('files', []) as $file) {
            $medicalResult->addMedia($file)->toMediaCollection('files');
        }

        return new MedicalResultResource($medicalResult);
    }

    public function deleteFile(Request $request, Media $media)
    {
        $media->delete();

        return response()->json([
            'status' => true,
            'message' => [
                'ar' => 'تم حذف الملف بنجاح',
                'en' => 'File deleted successfully',
            ],
        ]);
    }
}
