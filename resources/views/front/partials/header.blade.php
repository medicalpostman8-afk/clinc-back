<!-- Header -->
<header class="site-header header mo-left header-transparent @if ($darkMode) text-white @else text-black @endif absolute w-full">
    <!-- Main Header -->
    <div class="sticky-header main-bar-wraper navbar-expand-lg @if (!$darkMode) light @endif">
        <div class="main-bar clearfix ">
            <div class="container clearfix">

                <!-- Website Logo -->
                @if ($darkMode)
                    <div class="logo-header logo-dark">
                        <a href="{{ route('home') }}">
                            <img src="{{ Cache::get('light_mode_logo') }}" />
                        </a>
                    </div>
                    <div class="logo-header logo-white">
                        <a href="{{ route('home') }}">
                            <img src="{{ Cache::get('dark_mode_logo') }}" />
                        </a>
                    </div>
                @else
                    <div class="logo-header logo-dark">
                        <a href="{{ route('home') }}">
                            <img src="{{ Cache::get('light_mode_logo') }}" />
                        </a>
                    </div>
                @endif

                <!-- Nav Toggle Button -->
                <button class="navbar-toggler navicon justify-end" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>

                @if (Route::has('login'))
                    <!-- Extra Nav -->
                    <div class="extra-nav max-sm:!hidden">
                        <div class="extra-cell">
                            @guest
                                <a href="{{ route('login') }}" class="btn py-5 px-[35px] max-xl:py-3 max-xl:px-[25px] text-[15px] max-xl:text-sm inline-block font-medium leading-[1.2] uppercase bg-primary hover:bg-primaryhover text-white rounded duration-700 group">
                                    {{ __('auth.login.title') }}
                                    <i class="fa fa-angle-right ltr:ml-2.5 rtl:mr-2.5 duration-1000 group-hover:animate-toLeftFromRight"></i>
                                </a>
                            @else
                                @can('view dashboard')
                                    <a href="{{ route('dashboard.overview') }}" class="btn py-5 px-[35px] max-xl:py-3 max-xl:px-[25px] text-[15px] max-xl:text-sm inline-block font-medium leading-[1.2] uppercase bg-primary hover:bg-primaryhover text-white rounded duration-700 group">
                                        {{ __('ui.dashboard') }}
                                        <i class="fa fa-angle-right ltr:ml-2.5 rtl:mr-2.5 duration-1000 group-hover:animate-toLeftFromRight"></i>
                                    </a>
                                @else
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn py-5 px-[35px] max-xl:py-3 max-xl:px-[25px] text-[15px] max-xl:text-sm inline-block font-medium leading-[1.2] uppercase bg-primary hover:bg-primaryhover text-white rounded duration-700 group">
                                            {{ __('auth.logout') }}
                                            <i class="fa fa-angle-right ltr:ml-2.5 rtl:mr-2.5 duration-1000 group-hover:animate-toLeftFromRight"></i>
                                        </button>
                                    </form>
                                @endcan
                            @endguest
                        </div>
                    </div>
                @endif

                <div class="header-nav navbar-collapse justify-end" id="navbarNavDropdown">
                    <div class="logo-header logo-dark">
                        <a href="{{ route('home') }}">
                            <x-app-logo />
                        </a>
                    </div>
                    <ul class="nav navbar-nav navbar">
                        <li>
                            <a href="{{ route('home') }}">{{ __('ui.home') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('front.pages.show', ['page' => 'about-us']) }}">{{ __('ui.about-us') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('front.contacts.index') }}">{{ __('ui.contact-us') }}</a>
                        </li>

                        @if (Route::has('setlocale'))
                            <li>
                                <a href="{{ route('setlocale', ['code' => $language->code]) }}">
                                    {{ $language->name }}
                                </a>
                            </li>
                        @endif

                        @if (Route::has('login'))
                            <li class="sm:hidden">
                                @guest
                                    <a href="{{ route('login') }}">
                                        {{ __('auth.login.title') }}
                                    </a>
                                @else
                                    <a href="{{ route('dashboard.settings.index') }}">
                                        {{ __('ui.dashboard') }}
                                    </a>
                                @endguest
                            </li>
                        @endif
                    </ul>
                    <div class="dlab-social-icon">
                        <ul>
                            @if ($app->facebook)
                                <li><a target="_blank" href="{{ $app->facebook }}"><i class="fab fa-facebook-f text-primary"></i></a></li>
                            @endif
                            @if ($app->twitter)
                                <li><a target="_blank" href="{{ $app->twitter }}"><i class="fab fa-twitter text-primary"></i></a></li>
                            @endif
                            @if ($app->instagram)
                                <li><a target="_blank" href="{{ $app->instagram }}"><i class="fab fa-instagram text-primary"></i></a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main Header End -->
</header>
<!-- Header End -->
