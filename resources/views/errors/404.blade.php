<x-layouts.front :page="__('ui.page_not_found')">

    <!-- Error Page -->
    <div class="section-full pt-20" style="background-image: url({{ asset('front/images/background/bg1.png') }});">
        <div class="container">
            <div class="py-[150px] max-sm:py-[50px] text-center">
                <div class="text-[190px] max-sm:text-[120px] max-sm:leading-[120px] font-bold leading-[160px] m-auto text-primary opacity-20">404</div>
                <h2 class="text-[30px] max-sm:text-2xl font-medium mt-[15px] mb-[25px] max-w-[600px] leading-10 max-sm:leading-[34px] mx-auto">{{ __('ui.404_description') }}</h2>
                <a href="{{ route('home') }}" class="py-5 px-[35px] max-xl:py-3 max-xl:px-[25px] text-[15px] max-xl:text-sm inline-block font-medium leading-[1.2] uppercase bg-primary hover:bg-primaryhover text-white rounded duration-700 group"><span class="px-[15px]">{{ __('ui.back_to_home_page') }}</span></a>
            </div>
        </div>
    </div>
    <!-- Error Page End -->

</x-layouts.front>
