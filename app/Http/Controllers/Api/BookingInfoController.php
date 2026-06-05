<?php

namespace App\Http\Controllers\Api;

use App\Models\BookingInfo;
use App\Http\Requests\BookingInfoRequest;
use App\Utils\Http\Controllers\ApiController;

class BookingInfoController extends ApiController
{
    public function index()
    {
        return response()->json([
            'status' => true,
            'data' => BookingInfo::latest()->get()
        ]);
    }

    public function store(BookingInfoRequest $request)
    {
        $booking = BookingInfo::create($request->validated());

        return response()->json([
            'status' => true,
            'message' => 'Booking info created successfully',
            'data' => $booking
        ]);
    }

    public function show(BookingInfo $bookingInfo)
    {
        return response()->json([
            'status' => true,
            'data' => $bookingInfo
        ]);
    }

    public function update(
        BookingInfoRequest $request,
        BookingInfo $bookingInfo
    ) {
        $bookingInfo->update($request->validated());

        return response()->json([
            'status' => true,
            'message' => 'Booking info updated successfully',
            'data' => $bookingInfo
        ]);
    }

    public function destroy(BookingInfo $bookingInfo)
    {
        $bookingInfo->delete();

        return response()->json([
            'status' => true,
            'message' => 'Booking info deleted successfully'
        ]);
    }
}
