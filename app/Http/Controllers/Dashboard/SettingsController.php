<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageRequest;
use App\Http\Requests\Settings\BasicInformationRequest;
use App\Http\Requests\Settings\LandingPageRequest;
use App\Http\Requests\Settings\SocialLinksRequest;
use App\Http\Resources\SettingsResource;
use App\Models\Page;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SettingsController extends Controller
{
    public function index(Request $request)
    {
        Gate::authorize('manage settings');

        $settings = Settings::first();

        $tab = $request->tab;

        $iconUrl = Cache::get('icon');

        $lightModeLogoUrl = Cache::get('light_mode_logo');

        $darkModeLogoUrl = Cache::get('dark_mode_logo');

        return view('dashboard.settings.index', compact('tab', 'settings', 'iconUrl', 'lightModeLogoUrl', 'darkModeLogoUrl'));
    }

    public function update_basic_information(BasicInformationRequest $request)
    {
        Gate::authorize('manage settings');

        $settings = Settings::first();

        $settings->update($request->validated());

        // Update logo (light mode)
        if ($request->light_mode_logo) {
            $settings->addMediaFromRequest('light_mode_logo')->toMediaCollection('light_mode_logo');
        }

        // Update logo (dark mode)
        if ($request->dark_mode_logo) {
            $settings->addMediaFromRequest('dark_mode_logo')->toMediaCollection('dark_mode_logo');
        }

        // Update icon
        if ($request->icon) {
            $settings->addMediaFromRequest('icon')->toMediaCollection('icon');
        }

        $settings->updateCache();

        return redirect()
            ->route('dashboard.settings.index', ['tab' => 'basic-information'])
            ->with(['status' => __('ui.updated_successfully')]);
    }

    public function update_social_links(SocialLinksRequest $request)
    {
        Gate::authorize('manage settings');

        $settings = Settings::first();

        $settings->update($request->validated());

        $settings->updateCache();

        return redirect()
            ->route('dashboard.settings.index', ['tab' => 'social-links'])
            ->with(['status' => __('ui.updated_successfully')]);
    }

    public function update_landing_page(LandingPageRequest $request)
    {
        Gate::authorize('manage settings');

        $settings = Settings::first();

        $data = [
            'ar' => [
                'welcome_message_title' => $request->welcome_message_title['ar'],
                'welcome_message' => $request->welcome_message['ar'],
                'welcome_message_description' => $request->welcome_message_description['ar'],
            ],
            'en' => [
                'welcome_message_title' => $request->welcome_message_title['en'],
                'welcome_message' => $request->welcome_message['en'],
                'welcome_message_description' => $request->welcome_message_description['en'],
            ]
        ];

        $settings->update([
            'landing_page' => $data
        ]);

        $settings->updateCache();

        return redirect()
            ->route('dashboard.settings.index', ['tab' => 'landing-page'])
            ->with(['status' => __('ui.updated_successfully')]);
    }

    public function edit_default_page($pageName)
    {
        Gate::authorize('manage settings');

        $page = Page::getDefaultPage($pageName);

        return view('dashboard.settings.edit-default-page', compact('page'));
    }

    public function update_default_page(Page $page, PageRequest $request)
    {
        Gate::authorize('manage settings');

        $page->update($request->validated());

        return redirect()->back()->with(['status' => __('ui.updated_successfully')]);
    }
}
