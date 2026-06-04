<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BannerResource;
use App\Http\Resources\BlogResource;
use App\Http\Resources\ReservationResource;
use App\Http\Resources\UserResource;
use App\Models\Banner;
use App\Models\Blog;
use App\Models\Reservation;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    private function getReservationSteps($patientId): array
    {
        $pendingReservations = Reservation::query()
            ->where('patient_id', $patientId)
            ->where('status', 'pending')
            ->whereDate('date', '>=', now()->toDateString())
            ->orderBy('date')
            ->orderBy('time')
            ->take(5)
            ->get();

        $steps = [];

        for ($i = 1; $i <= 5; $i++) {
            $reservation = $pendingReservations->get($i - 1);

            $steps[] = [
                'number' => $i,
                'label' => match ($i) {
                    1 => 'الحالي',
                    5 => 'دورك',
                    default => 'في الإنتظار',
                },
                'status' => $reservation ? 'active' : 'empty',
                'reservation_id' => $reservation?->id,
                'date' => $reservation?->date,
                'time' => $reservation?->time,
            ];
        }

        return $steps;
    }

    private function getNextReservationText($reservation): ?string
    {
        if (! $reservation || ! $reservation->date || ! $reservation->time) {
            return null;
        }

        $reservationDateTime = \Carbon\Carbon::parse($reservation->date . ' ' . $reservation->time);

        $minutes = now()->diffInMinutes($reservationDateTime, false);

        if ($minutes <= 0) {
            return 'دورك الآن';
        }

        return 'دورك بعد ' . $minutes . ' دقيقة';
    }

    public function index(Request $request)
    {
        $user = $request->user();

        $patientId = $user->patient?->id ?? $user->id;

        $reservationsQuery = Reservation::query()
            ->with(['doctor', 'patient'])
            ->where('patient_id', $patientId);

        $upcomingReservations = (clone $reservationsQuery)
            ->where('status', 'pending')
            ->whereDate('date', '>=', now()->toDateString())
            ->orderBy('date')
            ->orderBy('time')
            ->limit(5)
            ->get();

        $currentReservation = (clone $reservationsQuery)
            ->where('status', 'pending')
            ->whereDate('date', '>=', now()->toDateString())
            ->orderBy('date')
            ->orderBy('time')
            ->first();

        return response()->json([
            'status' => true,
            'message' => [
                'ar' => 'تم جلب الرئيسية بنجاح',
                'en' => 'Home fetched successfully',
            ],
            'data' => [
                'user' => new UserResource($user->load('patient')),

                'banners' => BannerResource::collection(
                    Banner::query()->latest()->get()
                ),

                'reservation_steps' => $this->getReservationSteps($patientId),

                'current_reservation' => $currentReservation
                    ? new ReservationResource($currentReservation)
                    : null,

                'upcoming_reservations' => ReservationResource::collection($upcomingReservations),

                'reservations_summary' => [
                    'pending' => (clone $reservationsQuery)->where('status', 'pending')->count(),
                    'completed' => (clone $reservationsQuery)->where('status', 'completed')->count(),
                    'cancelled' => (clone $reservationsQuery)->where('status', 'cancelled')->count(),
                ],
                'next_reservation_text' => $this->getNextReservationText($currentReservation),
                // 'blogs' => BlogResource::collection(
                //     Blog::query()->latest()->limit(5)->get()
                // ),
            ],
        ]);
    }
}
