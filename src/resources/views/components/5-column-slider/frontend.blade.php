<div class="laravel_block2_thumbnail" id="laravel_block2_thumbnail_{{$page_element_id}}">
    <x-frontend.row>
        <div class="-mx-4">
            <div class="swiper" id="laravel_block2_thumbnail_{{$page_element_id}}_swiper">
                <div class="swiper-wrapper flex items-stretch">
                    @foreach ($collections as $item)
                        <div class="swiper-slide" style="height: auto">
                            <x-LaravelBlock2ThumbnailItem :content="$item" />
                        </div>            
                    @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </x-frontend.row>
</div>

@push('js')
    <script>
        gsap.from("#laravel_block2_thumbnail_{{$page_element_id}}_swiper .swiper-slide", {
            scrollTrigger:{
                trigger: "#laravel_block2_thumbnail_{{$page_element_id}}_swiper",
                start: 'top 60%',
                once: true
            },
            y: 200,
            opacity: 0,
            stagger: 0.1,
            duration: 0.6,
        });

        new Swiper("#laravel_block2_thumbnail_{{$page_element_id}}_swiper", {
            slidesPerView: 1,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                768: {
                    slidesPerView: 2
                },
                1024: {
                    slidesPerView: 3
                },
                1200: {
                    slidesPerView: 4
                },
                1400: {
                    slidesPerView: 5
                },
            }
      /*       mousewheel: true,
            keyboard: true, */
        });
    </script>
@endpush



