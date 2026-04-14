<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class OverviewController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        Gate::authorize('view dashboard');

        $usersCount = number_format(User::count());
        $contactRequestCount = number_format(Contact::count());

        return view('dashboard.overview.index', compact(
            'usersCount',
            'contactRequestCount'
        ));
    }
}
