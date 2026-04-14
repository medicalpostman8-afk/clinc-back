<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $page = Page::active()
            ->where('tag', $request->page)
            ->orWhere('id', $request->page)
            ->firstOrFail();

        return view('front.pages.show', compact('page'));
    }
}
