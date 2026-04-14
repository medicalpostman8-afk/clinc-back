<x-layouts.front :page="$page->name" :dark-mode="true">

    @push('styles')
        @vite('resources/css/ckeditor.css')
    @endpush

    <!-- Banner  -->
    <div class="dlab-bnr-inr style-1 bg-primary w-full h-[480px] max-sm:h-[300px] bg-center bg-[length:cover,_200%] relative overflow-hidden" style="background-image: url({{ asset('front/images/banner/bnr2.png') }}), var(--gradient-sec);">
        <div class="container table h-full relative z-1">
            <div class="h-full table-cell align-middle text-white relative text-center dlab-bnr-inr-entry">
                <h1 class="!text-white mb-5 max-sm:mb-[5px] text-[60px] max-lg:text-[40px] max-sm:!text-[32px] leading-[75px] max-lg:leading-[1.2]">{{ $page->name }}</h1>
                <!-- Breadcrumb Row -->
                <nav class="breadcrumb-row max-md:inline-block">
                    <ul class="inline-flex flex-wrap gradient bg-[length:200%] duration-1000 py-[5px] px-5 rounded-[30px]">
                        <li class="ltr:mr-[3px] rtl:ml-[3px] flex items-center text-lg max-lg:text-[15px] font-poppins"><a href="{{ route('home') }}">{{ __('ui.home') }}</a></li>
                        <li class="ltr:mr-[3px] rtl:ml-[3px] flex items-center text-lg max-lg:text-[15px] font-poppins ltr:pl-2 rtl:pr-2 before:content-['\f105'] before:font-['Line_Awesome_Free'] before:font-bold ltr:before:pr-2 rtl:before:pl-2 active">{{ $page->name }}</li>
                    </ul>
                </nav>
                <!-- Breadcrumb Row End -->
            </div>
        </div>
    </div>
    <!-- Banner End -->

    <div class="container">
        <div class="pb-12 ck-content">
            {!! $page->body !!}
        </div>
    </div>

</x-layouts.front>
