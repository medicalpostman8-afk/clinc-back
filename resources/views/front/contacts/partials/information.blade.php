<div class="lg:pt-[115px] sm:pt-[70px] pt-[50px]">
    <div class="container">
        <div class="row mt-7.5">
            <div class="lg:w-1/3 md:w-1/2 w-full">
                <div class="relative p-7.5 rounded shadow-[0_0_95px_0px_rgba(0,0,0,0.1)] duration-1000 hover:translate-y-2.5 max-lg:mb-[60px]">
                    <div class="mt-[-70px] mb-5 border-box relative top-0px block shadow-wrapper bg-[length:200%] duration-1000 gradient size-20 leading-[80px] text-center rounded-full">
                        <a href="tel:{{ $settings->phone }}" class="text-white">
                            <i class="las la-phone-volume text-[40px] align-middle"></i>
                        </a>
                    </div>
                    <div class="overflow-hidden">
                        <h4 class="mb-2.5">{{ __('validation.attributes.phone') }}</h4>
                        <a href="tel:{{ $settings->phone }}" class="text-xl max-xl:text-base leading-[1.4] mb-[5px]">{{ $settings->phone }}</a>
                    </div>
                </div>
            </div>
            <div class="lg:w-1/3 md:w-1/2 w-full">
                <div class="relative p-7.5 rounded shadow-[0_0_95px_0px_rgba(0,0,0,0.1)] duration-1000 hover:translate-y-2.5 max-lg:mb-[60px]">
                    <div class="mt-[-70px] mb-5 border-box relative top-0px block shadow-wrapper bg-[length:200%] duration-1000 gradient size-20 leading-[80px] text-center rounded-full">
                        <a href="javascript:void(0);" class="text-white">
                            <i class="las la-map-marker text-[40px] align-middle"></i>
                        </a>
                    </div>
                    <div class="overflow-hidden">
                        <h4 class="mb-2.5">{{ __('validation.attributes.address') }}</h4>
                        <p class="text-xl max-xl:text-base leading-[1.4] mb-[5px]">{{ $settings->address }}</p>
                    </div>
                </div>
            </div>
            <div class="lg:w-1/3 w-full">
                <div class="relative p-7.5 rounded shadow-[0_0_95px_0px_rgba(0,0,0,0.1)] duration-1000 hover:translate-y-2.5">
                    <div class="mt-[-70px] mb-5 border-box relative top-0px block shadow-wrapper bg-[length:200%] duration-1000 gradient size-20 leading-[80px] text-center rounded-full">
                        <a href="mailto:{{ $settings->email }}" class="text-white">
                            <i class="las la-envelope-open text-[40px] align-middle"></i>
                        </a>
                    </div>
                    <div class="overflow-hidden">
                        <h4 class="mb-2.5">{{ __('validation.attributes.email') }}</h4>
                        <a href="mailto:{{ $settings->email }}" class="text-xl max-xl:text-base leading-[1.4] mb-[5px]">{{ $settings->email }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
