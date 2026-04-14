<!-- Footer -->

<footer class="site-footer style-1 bg-[url('../images/background/bg10.png')] bg-no-repeat bg-center bg-cover bg-primary text-[15px] text-white" id="footer">
    <div class="pt-[70px] pb-7.5 max-md:pt-[50px] max-md:pb-5 bg-transparent">
        <div class="container">
            <div class="mb-7.5 pb-2.5 border-b border-[#ffffff4d] wow fadeIn" data-wow-duration="2s" data-wow-delay="0.8s">
                <div class="row items-center">
                    <div class="xl:w-5/12 md:w-1/3 w-full">
                        <div class="mb-2.5">
                            <a href="index.html"><img src="{{ Cache::get('dark_mode_logo') }}" class="max-h-12" alt="/"></a>
                        </div>
                    </div>
                    <div class="xl:w-1/4 md:w-1/3 sm:w-1/2 w-full">
                        <div class="flex items-center relative mb-2.5">
                            <div class="ltr:float-left rtl:float-right ltr:mr-2.5 rtl:ml-2.5 inline-block text-center w-20 min-w-20">
                                <a href="javascript:void(0);" class="text-white">
                                    <i class="flaticon-email text-[50px]"></i>
                                </a>
                            </div>
                            <div class="overflow-hidden">
                                <p class="text-base max-xl:text-[15px] text-[#ffffff99] mb-0">
                                    <a href="tel:{{ $app->phone }}" class="text-white font-extrabold md:text-lg text-base">{{ $app->phone }}</a><br><a href="mailto:{{ $app->email }}">{{ $app->email }}</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="md:w-1/3 sm:w-1/2 w-full">
                        <div class="flex items-center relative mb-2.5">
                            <div class="ltr:float-left rtl:float-right ltr:mr-2.5 rtl:ml-2.5 inline-block text-center w-20 min-w-20">
                                <a href="javascript:void(0);" class="text-white">
                                    <i class="flaticon-location text-[50px]"></i>
                                </a>
                            </div>
                            <div class="overflow-hidden">
                                <p class="text-base max-xl:text-[15px] text-[#ffffff99] mb-0">{{ $app->address }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="xl:w-1/4 lg:w-1/3 sm:w-1/2 w-full wow fadeIn" data-wow-duration="2s" data-wow-delay="0.2s">
                    <div class="mb-7.5 widget_about">
                        <h5 class="footer-title text-2xl font-bold pb-2.5 mb-7.5 relative !text-white leading-[1.2]">{{ __('ui.about-us') }}</h5>
                        <p class="mb-5 leading-6 opacity-60">{{ $app->description }}</p>
                        <div class="dlab-social-icon">
                            <ul>
                                @if ($app->facebook)
                                    <li class="inline-block"><a class="fab fa-facebook-f size-8 leading-8 text-center rounded-full text-sm text-primary bg-white m-0.5 duration-500 hover:text-white hover:bg-primary" href="{{ $app->facebook }}"></a></li>
                                @endif
                                @if ($app->twitter)
                                    <li class="inline-block"><a class="fab fa-twitter size-8 leading-8 text-center rounded-full text-sm text-primary bg-white m-0.5 duration-500 hover:text-white hover:bg-primary" href="{{ $app->twitter }}"></a></li>
                                @endif
                                @if ($app->instagram)
                                    <li class="inline-block"><a class="fab fa-instagram size-8 leading-8 text-center rounded-full text-sm text-primary bg-white m-0.5 duration-500 hover:text-white hover:bg-primary" href="{{ $app->instagram }}"></a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="xl:w-1/4 lg:w-1/6 sm:w-1/2 w-full wow fadeIn" data-wow-duration="2s" data-wow-delay="0.4s">
                    <div class="mb-7.5 widget_services">
                        <h5 class="footer-title text-2xl font-bold pb-2.5 mb-7.5 relative !text-white leading-[1.2]">{{ __('ui.our_links') }}</h5>
                        <ul class="mt-[-5px] text-[#ffffff99]">
                            <li class="py-2 px-[15px] leading-5 relative"><a href="{{ route('home') }}" class="relative duration-500 hover:text-white">{{ __('ui.home') }}</a></li>
                            <li class="py-2 px-[15px] leading-5 relative"><a href="{{ route('front.pages.show', ['page' => 'about-us']) }}" class="relative duration-500 hover:text-white">{{ __('ui.about-us') }}</a></li>
                            <li class="py-2 px-[15px] leading-5 relative"><a href="{{ route('front.contacts.index') }}" class="relative duration-500 hover:text-white">{{ __('ui.contact-us') }}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="lg:w-1/4 sm:w-1/2 w-full wow fadeIn" data-wow-duration="2s" data-wow-delay="0.6s">
                    <div class="mb-7.5 widget_services">
                        <h5 class="footer-title text-2xl font-bold pb-2.5 mb-7.5 relative !text-white leading-[1.2]">{{ __('ui.pages') }}</h5>
                        <ul class="mt-[-5px] text-[#ffffff99]">
                            @foreach ($pages as $page)
                                <li class="py-2 px-[15px] leading-5 relative"><a href="{{ route('front.pages.show', ['page' => $page->id]) }}" class="relative duration-500 hover:text-white">{{ $page->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="lg:w-1/4 sm:w-1/2 w-full wow fadeIn" data-wow-duration="2s" data-wow-delay="0.8s">
                    <div class="mb-7.5 widget_services">
                        <h5 class="footer-title text-2xl font-bold pb-2.5 mb-7.5 relative !text-white leading-[1.2]">{{ __('ui.other_links') }}</h5>
                        <ul class="mt-[-5px] text-[#ffffff99]">
                            <li class="py-2 px-[15px] leading-5 relative"><a href="{{ route('front.pages.show', ['page' => 'privacy-policy']) }}" class="relative duration-500 hover:text-white">{{ __('ui.privacy-policy') }}</a></li>
                            <li class="py-2 px-[15px] leading-5 relative"><a href="{{ route('front.pages.show', ['page' => 'terms-and-conditions']) }}" class="relative duration-500 hover:text-white">{{ __('ui.terms-and-conditions') }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer bottom part -->
    <div class="bg-primarydark py-[15px] wow fadeIn" data-wow-duration="2s" data-wow-delay="0.2s">
        <div class="container">
            <div class="row">
                <div class="w-full text-center">
                    <span class="text-[#ffffff80]">{{ __('ui.copyright') }} &copy; {{ date('Y') }} {{ $app->name }}. {{ __('ui.developed_by') }} <a href="https://khelj.com" target="_blank" class="text-white font-normal">{{ __('ui.khalej') }}</a></span>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer End -->
