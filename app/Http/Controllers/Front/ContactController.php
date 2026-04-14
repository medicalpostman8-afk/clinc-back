<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Illuminate\Support\Facades\Cache;

class ContactController extends Controller
{
    public function index()
    {
        $settings = Cache::get('settings');

        return view('front.contacts.index', compact('settings'));
    }

    public function store(ContactRequest $request)
    {
        Contact::create($request->validated());

        return redirect()->back()->with(['status' => __('ui.sent_successfully')]);
    }
}
