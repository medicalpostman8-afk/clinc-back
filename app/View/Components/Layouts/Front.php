<?php

namespace App\View\Components\Layouts;

use App\Models\Page;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;
use stdClass;

class Front extends Component
{
    public string $locale;

    public string $dir;

    public stdClass $language;

    public stdClass $app;

    public string $title;

    public Collection|array $pages;

    /**
     * Create a new component instance.
     */
    public function __construct(
        public string|null $page = null,
        public bool $darkMode = false,
    ) {
        $this->locale = App::getLocale();

        $this->dir = $this->locale == 'ar'
            ? 'rtl'
            : 'ltr';

        $this->language = new stdClass();

        $this->language->name = $this->locale == 'ar'
            ? 'English'
            : 'العربية';

        $this->language->code = $this->locale == 'ar'
            ? 'en'
            : 'ar';

        $settings = Cache::get('settings');

        $icon = Cache::get('icon');

        $this->app = new stdClass();
        $this->app->name = $settings?->name;
        $this->app->description = $settings?->description;
        $this->app->keywords = $settings?->keywords;
        $this->app->phone = $settings?->phone;
        $this->app->email = $settings?->email;
        $this->app->address = $settings?->address;
        $this->app->facebook = $settings?->facebook_url;
        $this->app->twitter = $settings?->twitter_url;
        $this->app->instagram = $settings?->instagram_url;
        $this->app->icon = $icon;

        $pageTitle = $page ? "$page | " : null;

        $this->pages = Page::active()
            ->notDefaultPages()
            ->get(['id', 'name']);

        $this->title = "$pageTitle {$this->app->name}";
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('layouts.front');
    }
}
