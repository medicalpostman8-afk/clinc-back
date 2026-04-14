<div class="lg:pt-[115px] lg:pb-[85px] sm:pt-[70px] sm:pb-10 pt-[50px] pb-5" style="background-image: url({{ asset('front/images/background/bg1.png') }});">
    <div class="container">
        <div class="row items-center">
            <div class="xl:w-1/2 lg:w-7/12 mb-7.5 wow fadeInLeft" data-wow-duration="2s" data-wow-delay="0.2s">
                <div class="mb-10 max-xl:mb-7.5">
                    <h6 class="!text-[#777777] text-[22px] inline-block mb-0 max-xl:text-lg">{{ __('ui.contact-us') }}</h6>
                    <h2 class="title">{{ __('ui.get_in_touch') }}</h2>
                </div>

                <form class="dlab-form dzForm" method="POST" action="{{ route('front.contacts.store') }}">
                    @csrf

                    <div class="row">
                        <div class="w-full">
                            <div class="mb-5 relative flex flex-wrap items-stretch w-full">
                                <div class="absolute ltr:left-2.5 rtl:right-2.5 top-[36px] z-99 -translate-y-2/4 bg-transparent ltr:border-r rtl:border-l border-[#9192a4] ltr:mr-2.5 rtl:ml-2.5">
                                    <span class="w-10 h-5 flex items-center justify-center"><i class="la la-pen text-primary text-[22px]"></i></span>
                                </div>
                                <input name="subject" type="text" value="{{ old('subject') }}" required class="py-2.5 ltr:pr-5 rtl:pl-5 ltr:pl-[65px] rtl:pr-[65px] relative flex-auto w-[1%] outline-none rounded border border-[#cccccc] focus:border-primary h-[60px] max-xl:h-[50px]" placeholder="{{ __('validation.attributes.subject') }}">
                            </div>
                            @error('subject')
                                <div>
                                    <p class="text-theme-xs text-red-500 mt-1.5">{{ $message }}</p>
                                </div>
                            @enderror
                        </div>
                        <div class="w-full">
                            <div class="mb-5 relative flex flex-wrap items-stretch w-full">
                                <div class="absolute ltr:left-2.5 rtl:right-2.5 top-[36px] z-99 -translate-y-2/4 bg-transparent ltr:border-r rtl:border-l border-[#9192a4] ltr:mr-2.5 rtl:ml-2.5">
                                    <span class="w-10 h-5 flex items-center justify-center"><i class="la la-user text-primary text-[22px]"></i></span>
                                </div>
                                <input name="name" type="text" value="{{ old('name') }}" class="py-2.5 ltr:pr-5 rtl:pl-5 ltr:pl-[65px] rtl:pr-[65px] relative flex-auto w-[1%] outline-none rounded border border-[#cccccc] focus:border-primary h-[60px] max-xl:h-[50px]" required placeholder="{{ __('validation.attributes.name') }}">
                            </div>
                            @error('name')
                                <div>
                                    <p class="text-theme-xs text-red-500 mt-1.5">{{ $message }}</p>
                                </div>
                            @enderror
                        </div>
                        <div class="sm:w-1/2 w-full">
                            <div class="mb-5 relative flex flex-wrap items-stretch w-full">
                                <div class="absolute ltr:left-2.5 rtl:right-2.5 top-[36px] z-99 -translate-y-2/4 bg-transparent ltr:border-r rtl:border-l border-[#9192a4] ltr:mr-2.5 rtl:ml-2.5">
                                    <span class="w-10 h-5 flex items-center justify-center"><i class="la la-envelope text-primary text-[22px]"></i></span>
                                </div>
                                <input name="email" type="email" value="{{ old('email') }}" required class="py-2.5 ltr:pr-5 rtl:pl-5 ltr:pl-[65px] rtl:pr-[65px] relative flex-auto w-[1%] outline-none rounded border border-[#cccccc] focus:border-primary h-[60px] max-xl:h-[50px]" placeholder="{{ __('validation.attributes.email') }}">
                            </div>
                            @error('email')
                                <div>
                                    <p class="text-theme-xs text-red-500 mt-1.5">{{ $message }}</p>
                                </div>
                            @enderror
                        </div>
                        <div class="sm:w-1/2 w-full">
                            <div class="mb-5 relative flex flex-wrap items-stretch w-full">
                                <div class="absolute ltr:left-2.5 rtl:right-2.5 top-[36px] z-99 -translate-y-2/4 bg-transparent ltr:border-r rtl:border-l border-[#9192a4] ltr:mr-2.5 rtl:ml-2.5">
                                    <span class="w-10 h-5 flex items-center justify-center"><i class="la la-phone text-primary text-[22px]"></i></span>
                                </div>
                                <input name="phone" type="text" value="{{ old('phone') }}" required class="py-2.5 ltr:pr-5 rtl:pl-5 ltr:pl-[65px] rtl:pr-[65px] relative flex-auto w-[1%] outline-none rounded border border-[#cccccc] focus:border-primary h-[60px] max-xl:h-[50px]" placeholder="{{ __('validation.attributes.phone') }}">
                            </div>
                            @error('phone')
                                <div>
                                    <p class="text-theme-xs text-red-500 mt-1.5">{{ $message }}</p>
                                </div>
                            @enderror
                        </div>
                        <div class="w-full mb-5">
                            <div class="mb-5 relative flex flex-wrap items-stretch w-full">
                                <div class="absolute ltr:left-2.5 rtl:right-2.5 top-[36px] z-99 -translate-y-2/4 bg-transparent ltr:border-r rtl:border-l border-[#9192a4] ltr:mr-2.5 rtl:ml-2.5">
                                    <span class="w-10 h-5 flex items-center justify-center"><i class="la la-sms text-primary text-[22px]"></i></span>
                                </div>
                                <textarea name="message" required class="sm:py-[18px] py-2.5 ltr:pr-5 rtl:pl-5 ltr:pl-[65px] rtl:pr-[65px] relative flex-auto w-[1%] outline-none rounded border border-[#cccccc] focus:border-primary h-[120px] resize-y" placeholder="{{ __('validation.attributes.message') }}">{{ old('message') }}</textarea>
                            </div>
                            @error('message')
                                <div>
                                    <p class="text-theme-xs text-red-500 mt-1.5">{{ $message }}</p>
                                </div>
                            @enderror
                        </div>
                        <div class="w-full">
                            <button type="submit" class="btn py-5 px-[35px] max-xl:py-3 max-xl:px-[25px] text-[15px] max-xl:text-sm inline-block font-medium leading-[1.2] uppercase bg-primary hover:bg-primaryhover text-white rounded duration-700 group">
                                {{ __('ui.submit') }}
                                <i class="fa fa-angle-right ltr:ml-2.5 rtl:mr-2.5 duration-1000 group-hover:animate-toLeftFromRight"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="xl:w-1/2 lg:w-5/12 mb-7.5 wow fadeInRight" data-wow-duration="2s" data-wow-delay="0.2s">
                <div class="ltr:-mr-20 ltr:max-2xl:mr-0 rtl:-ml-20 rtl:max-2xl:ml-0 relative overflow-hidden">
                    <img src="{{ asset('front/images/services/Mail sent-pana.svg') }}" class="animate-move_4" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
