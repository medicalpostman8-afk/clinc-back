<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\BannerRequest;
use App\Http\Resources\BannerResource;
use App\Models\Banner;
use App\Utils\Http\Controllers\ApiController;

class BannerController extends ApiController
{
    public function index()
    {
        $banners = Banner::where('doctor_id', auth()
            ->id())->active()
            ->with(['media'])
            ->paginate($this->paginationLimit, ['id', 'name', 'url']);

        return BannerResource::collection($banners);
    }

    public function store(BannerRequest $request)
    {
        $doctor = auth()->user();

        $banner = Banner::create([
            ...$request->validated(),
            'doctor_id' => $doctor->id,
        ]);

        if ($request->hasFile('image')) {
            $banner->addMediaFromRequest('image')->toMediaCollection('banners');
        }

        return response()->json([
            'status' => true,
            'message' => [
                'ar' => 'تم إنشاء الإعلان بنجاح',
                'en' => 'Banner created successfully',
            ],
            'data' => new BannerResource($banner->load('media')),
        ]);
    }

    public function update(BannerRequest $request, Banner $banner)
    {
        $banner->update($request->validated());

        if ($request->hasFile('image')) {
            $banner->clearMediaCollection('banners');
            $banner->addMediaFromRequest('image')->toMediaCollection('banners');
        }

        return response()->json([
            'status' => true,
            'message' => [
                'ar' => 'تم تعديل الإعلان بنجاح',
                'en' => 'Banner updated successfully',
            ],
            'data' => new BannerResource($banner->load('media')),
        ]);
    }

    public function destroy(Banner $banner)
    {
        $banner->clearMediaCollection('banners');

        $banner->delete();

        return response()->json([
            'status' => true,
            'message' => [
                'ar' => 'تم حذف الإعلان بنجاح',
                'en' => 'Banner deleted successfully',
            ],
        ]);
    }
}
