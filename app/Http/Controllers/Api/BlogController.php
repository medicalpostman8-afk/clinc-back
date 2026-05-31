<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\BlogRequest;
use App\Http\Resources\BlogResource;
use App\Models\Blog;
use App\Utils\Http\Controllers\ApiController;

class BlogController extends ApiController
{
    public function index()
    {
        $doctor = auth()->user();

        $blogs = Blog::where('doctor_id', $doctor->id)
            ->latest()
            ->with('media')
            ->paginate($this->paginationLimit, ['id', 'title', 'description']);

        return BlogResource::collection($blogs);
    }

    public function store(BlogRequest $request)
    {
        $doctor = auth()->user();

        $blog = Blog::create([
            ...$request->validated(),
            'doctor_id' => $doctor->id,
        ]);

        if ($request->hasFile('image')) {
            $blog->addMediaFromRequest('image')->toMediaCollection('blogs');
        }

        return response()->json([
            'status' => true,
            'message' => [
                'ar' => 'تم إضافة المقال بنجاح',
                'en' => 'Blog created successfully',
            ],
            'data' => new BlogResource($blog->load('media')),
        ]);
    }

    public function update(BlogRequest $request, Blog $blog)
    {

        $blog->update(
            array_filter($request->validated(), fn($v) => !is_null($v))
        );

        if ($request->hasFile('image')) {
            $blog->clearMediaCollection('blogs');
            $blog->addMediaFromRequest('image')->toMediaCollection('blogs');
        }

        return response()->json([
            'status' => true,
            'message' => [
                'ar' => 'تم تعديل المقال بنجاح',
                'en' => 'Blog updated successfully',
            ],
            'data' => new BlogResource($blog->load('media')),
        ]);
    }

    public function destroy(Blog $blog)
    {

        $blog->clearMediaCollection('blogs');
        $blog->delete();

        return response()->json([
            'status' => true,
            'message' => [
                'ar' => 'تم حذف المقال بنجاح',
                'en' => 'Blog deleted successfully',
            ],
        ]);
    }
}
