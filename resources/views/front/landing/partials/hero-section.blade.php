<!-- Hero Section Start -->
<div class="banner-two h-[750px] max-xl:-[550px] max-md:!h-auto relative overflow-hidden ltr:bg-[url('../images/main-slider/slider1/pic2.png')] rtl:bg-[url('../images/rtl/mainslider/slider1/pic2.png')] bg-[left_bottom] bg-cover bg-no-repeat">
    <div class="container">
        <div class="banner-inner pt-[150px] max-md:pt-[120px] max-sm:!pt-[100px]">
            <div class="img1 absolute ltr:left-[100px] rtl:right-[100px] bottom-[50px] -z-1"><img src="assets/images/main-slider/slider1/pic3.png" alt=""></div>
            <div class="img2 absolute ltr:right-0 rtl:left-0 top-[120px]"><img src="assets/images/main-slider/slider1/pic4.png" alt=""></div>
            <div class="row items-center">
                <div class="lg:w-7/12 w-full">
                    <div class="max-md:mb-[50px]">
                        <h6 data-wow-duration="1s" data-wow-delay="0.5s" class="wow fadeInUp font-semibold text-[#777777] text-[22px] inline-block mb-3">{{ $data['welcome_message_title'] }}</h6>
                        <h1 data-wow-duration="1.2s" data-wow-delay="1s" class="wow fadeInUp mb-5 leading-[1.2]">{{ $data['welcome_message'] }}</h1>
                        <p data-wow-duration="1.4s" data-wow-delay="1.5s" class="wow fadeInUp mb-7.5 text-lg max-sm:text-[15px]">{{ $data['welcome_message_description'] }}</p>
                        <a href="{{ route('front.pages.show', ['page' => 'about-us']) }}" class="btn py-5 px-[35px] max-xl:py-3 max-xl:px-[25px] text-[15px] max-xl:text-sm inline-block font-medium leading-[1.2] uppercase bg-primary hover:bg-primaryhover text-white rounded duration-700 group">
                            {{ __('ui.learn_more') }}
                            <i class="fa fa-angle-right ltr:ml-2.5 rtl:mr-2.5 duration-1000 group-hover:animate-toLeftFromRight"></i>
                        </a>
                    </div>
                </div>
                <div class="lg:w-5/12 w-full">
                    <div class="w-[520px] h-auto max-2xl:w-full relative wow fadeIn" data-wow-duration="1.6s" data-wow-delay="0.8s">
                        <img class="animate-move" src="{{ asset('front/images/main-slider/slider1/Instant information-cuate.svg') }}" alt="/">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Hero Section End -->
