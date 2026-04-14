<x-layouts.front :page="__('ui.contact-us')" :dark-mode="true">

    <!-- Banner  -->
    <div class="dlab-bnr-inr style-1 bg-primary w-full h-[480px] max-sm:h-[300px] bg-center bg-[length:cover,_200%] relative overflow-hidden" style="background-image: url({{ asset('front/images/banner/bnr2.png') }}), var(--gradient-sec);">
        <div class="container table h-full relative z-1">
            <div class="h-full table-cell align-middle text-white relative text-center dlab-bnr-inr-entry">
                <h1 class="!text-white mb-5 max-sm:mb-[5px] text-[60px] max-lg:text-[40px] max-sm:!text-[32px] leading-[75px] max-lg:leading-[1.2]">{{ __('ui.contact-us') }}</h1>
                <!-- Breadcrumb Row -->
                <nav class="breadcrumb-row max-md:inline-block">
                    <ul class="inline-flex flex-wrap gradient bg-[length:200%] duration-1000 py-[5px] px-5 rounded-[30px]">
                        <li class="ltr:mr-[3px] rtl:ml-[3px] flex items-center text-lg max-lg:text-[15px] font-poppins"><a href="{{ route('home') }}">{{ __('ui.home') }}</a></li>
                        <li class="ltr:mr-[3px] rtl:ml-[3px] flex items-center text-lg max-lg:text-[15px] font-poppins ltr:pl-2 rtl:pr-2 before:content-['\f105'] before:font-['Line_Awesome_Free'] before:font-bold ltr:before:pr-2 rtl:before:pl-2 active">{{ __('ui.contact-us') }}</li>
                    </ul>
                </nav>
                <!-- Breadcrumb Row End -->
            </div>
        </div>
    </div>
    <!-- Banner End -->

    @session('status')
        <div class="my-5 container">
            <div class="rounded-xl border border-green-500 bg-green-50 p-4 dark:border-green-500/30 dark:bg-green-500/15">
                <div class="flex items-start gap-3">
                    <div class="-mt-0.5 text-green-500">
                        <svg
                            class="fill-current"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M3.70186 12.0001C3.70186 7.41711 7.41711 3.70186 12.0001 3.70186C16.5831 3.70186 20.2984 7.41711 20.2984 12.0001C20.2984 16.5831 16.5831 20.2984 12.0001 20.2984C7.41711 20.2984 3.70186 16.5831 3.70186 12.0001ZM12.0001 1.90186C6.423 1.90186 1.90186 6.423 1.90186 12.0001C1.90186 17.5772 6.423 22.0984 12.0001 22.0984C17.5772 22.0984 22.0984 17.5772 22.0984 12.0001C22.0984 6.423 17.5772 1.90186 12.0001 1.90186ZM15.6197 10.7395C15.9712 10.388 15.9712 9.81819 15.6197 9.46672C15.2683 9.11525 14.6984 9.11525 14.347 9.46672L11.1894 12.6243L9.6533 11.0883C9.30183 10.7368 8.73198 10.7368 8.38051 11.0883C8.02904 11.4397 8.02904 12.0096 8.38051 12.3611L10.553 14.5335C10.7217 14.7023 10.9507 14.7971 11.1894 14.7971C11.428 14.7971 11.657 14.7023 11.8257 14.5335L15.6197 10.7395Z"
                                fill="" />
                        </svg>
                    </div>

                    <div>
                        <h4 class="mb-1 text-sm font-semibold text-gray-800 dark:text-white/90">{{ $value }}</h4>
                    </div>
                </div>
            </div>

        </div>
    @endsession

    <div class="container items-center justify-center flex flex-col gap-5">
        @error('subject')
            <div>
                <p class="text-theme-xs text-red-500 mt-1.5">{{ $message }}</p>
            </div>
        @enderror
        @error('name')
            <div>
                <p class="text-theme-xs text-red-500 mt-1.5">{{ $message }}</p>
            </div>
        @enderror
        @error('email')
            <div>
                <p class="text-theme-xs text-red-500 mt-1.5">{{ $message }}</p>
            </div>
        @enderror
        @error('phone')
            <div>
                <p class="text-theme-xs text-red-500 mt-1.5">{{ $message }}</p>
            </div>
        @enderror
        @error('message')
            <div>
                <p class="text-theme-xs text-red-500 mt-1.5">{{ $message }}</p>
            </div>
        @enderror
    </div>

    @include('front.contacts.partials.information')

    @include('front.contacts.partials.form')

</x-layouts.front>
