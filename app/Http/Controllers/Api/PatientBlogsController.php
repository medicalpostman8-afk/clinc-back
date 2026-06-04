<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlogResource;
use App\Models\Blog;
use Illuminate\Http\Request;

class PatientBlogsController extends Controller
{
    public function index(Request $request)
    {
        $blogs = Blog::query()
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%')
                    ->orWhere('content', 'like', '%' . $request->search . '%');
            })
            ->latest()
            ->get();

        return BlogResource::collection($blogs);
    }

    public function show(Blog $blog)
    {
        return response()->json([
            'status' => true,
            'message' => [
                'ar' => 'تم جلب المقال بنجاح',
                'en' => 'Blog fetched successfully',
            ],
            'data' => new BlogResource($blog),
        ]);
    }
}
