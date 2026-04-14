<!DOCTYPE html>
<html lang="{{ $locale }}" dir="{{ $dir }}">

<head>

    <!-- TITLE -->
    <title>{{ $title }}</title>

    <!-- Meta -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="keywords" content="{{ $app->keywords }}">
    <meta name="description" content="{{ $app->description }}">
    <meta name="format-detection" content="telephone=no">

    <!-- Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" href="assets/images/favicon.png">

    <!-- Stylesheet -->
    <link href="{{ asset('front/vendor/niceselect/css/nice-select.css') }}" rel="stylesheet">

    <!-- ICONS CSS -->
    <link href="{{ asset('front/icons/flaticon/flaticon.css') }}" rel="stylesheet">
    <link href="{{ asset('front/icons/line-awesome/css/line-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('front/icons/font-awesome/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('front/icons/themify/themify-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('front/vendor/magnific-popup/magnific-popup.min.css') }}" rel="stylesheet">

    <!-- STYLESHEETS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('front/vendor/swiper/swiper-bundle.min.css') }}">
    <link href="{{ asset('front/vendor/animate/animate.css') }}" rel="stylesheet">

    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="{{ asset('front/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('front/vendor/switcher/switcher.css') }}">
    <link rel="stylesheet" href="{{ asset('front/vendor/rangeslider/rangeslider.css') }}">

    @vite('resources/css/front.css')

    @stack('styles')

</head>

<body id="bg" class="selection:bg-primary selection:text-white bg-fixed bg-cover font-Roboto bg-white skin-1">

    <div id="loading-area" class="fixed w-full h-full left-0 top-0 z-[999999999] bg-center bg-no-repeat bg-[length:80px] bg-[#f4f2ff] bg-[url('../images/loading-01.svg')] loading-01"></div>

    <div class="page-wraper">

        @include('front.partials.header')

        <div class="page-content bg-white">
            {{ $slot }}
        </div>

        @include('front.partials.footer')

        <button class="shadow-[-4px_4px_24px_-10px_var(--primary)] bg-primary rounded bottom-[15px] text-white size-[50px] leading-[50px] max-sm:size-10 max-sm:leading-10 max-sm:text-sm fixed ltr:right-[15px] rtl:left-[15px] text-center z-[999] duration-700 scroltop icon-up" type="button"><i class="fa fa-arrow-up"></i></button>
    </div>

    <!-- JAVASCRIPT FILES ========================================= -->

    <script src="{{ asset('front/js/jquery.min.js') }}"></script><!-- JQUERY.MIN JS -->
    <script src="{{ asset('front/vendor/wow/wow.js') }}"></script><!-- WOW JS -->

    <script src="{{ asset('front/vendor/imagesloaded/imagesloaded.js') }}"></script><!-- IMAGESLOADED -->
    <script src="{{ asset('front/vendor/masonry/isotope.pkgd.min.js') }}"></script><!-- ISOTOPE -->
    <script src="{{ asset('front/js/custom.js') }}"></script><!-- CUSTOM JS -->
    <script src="{{ asset('front/vendor/niceselect/js/jquery.nice-select.js') }}"></script>

    @stack('scripts')
</body>

</html>
