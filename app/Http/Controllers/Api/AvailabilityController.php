<?php

namespace App\Http\Controllers\Api;

use App\Models\Availability;
use Illuminate\Http\Request;
use App\Utils\Http\Controllers\ApiController;

class AvailabilityController extends ApiController
{
    public function index()
    {
        return Availability::where('doctor_id', auth()->id())
            ->orderBy('date')
            ->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'max_patients' => 'required|integer|min:1',
        ]);

        $availability = Availability::create([
            ...$request->all(),
            'doctor_id' => auth()->id(),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'تم إضافة اليوم',
            'data' => $availability
        ]);
    }

    public function destroy(Availability $availability)
    {

        $availability->delete();

        return response()->json([
            'status' => true,
            'message' => 'تم الحذف'
        ]);
    }
}
