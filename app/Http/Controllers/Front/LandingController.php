<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class LandingController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $settings = Cache::get('settings');

        $data = $settings->landing_page;

        $appDownloadLinks = [
            'google_play' => env('APP_URL_GOOGLE_PLAY'),
            'app_store' => env('APP_URL_APP_STORE'),
        ];

        return view('front.landing.index', compact('data', 'appDownloadLinks'));
    }
}
