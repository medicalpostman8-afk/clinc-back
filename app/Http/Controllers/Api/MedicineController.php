<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MedicineResource;
use App\Models\Medicine;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    public function index(Request $request)
    {
        return MedicineResource::collection(
            Medicine::where('name', 'like', "%{$request->search}%")
                ->limit(10)
                ->get()
        );
    }
}
