<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PageResource;
use App\Models\Page;

class GeneralController extends Controller
{
    public function show_default_page($pageName)
    {
        $page = Page::getDefaultPage($pageName);

        return new PageResource($page);
    }
}
