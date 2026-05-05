<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\InvoiceResource;
use App\Models\Reservation;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Reservation::query()
            ->with(['patient:id,name,phone', 'doctor:id,name'])
            ->where('doctor_id', auth()->id())
            ->where('status', 'completed')
            ->whereNotNull('price')
            ->where('price', '>', 0);

        if ($request->filled('from')) {
            $query->whereDate('date', '>=', $request->from);
        }

        if ($request->filled('to')) {
            $query->whereDate('date', '<=', $request->to);
        }

        $total = (clone $query)->sum('price');

        $invoices = $query
            ->latest('date')
            ->paginate(10);

        return InvoiceResource::collection($invoices)->additional([
            'status' => true,
            'summary' => [
                'total' => (float) $total,
                'count' => $invoices->total(),
            ],
        ]);
    }

    public function show(Reservation $reservation)
    {
        if (
            $reservation->doctor_id !== auth()->id()
            || $reservation->status !== 'completed'
            || is_null($reservation->price)
            || $reservation->price <= 0
        ) {
            return response()->json([
                'status' => false,
                'message' => [
                    'ar' => 'الفاتورة غير متاحة',
                    'en' => 'Invoice is not available',
                ],
            ]);
        }

        $reservation->load(['patient:id,name,phone', 'doctor:id,name']);

        return response()->json([
            'status' => true,
            'data' => new InvoiceResource($reservation),
        ]);
    }
}
