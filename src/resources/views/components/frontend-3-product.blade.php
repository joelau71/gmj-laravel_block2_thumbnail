<div class="grid grid-cols-2 md:grid-cols-3 gap-4 md:gap-9 mt-11 px-6 max-w-5xl mx-auto">
    @foreach ($collection as $item)
        <div class="product-thumbnail relative">
            @if ($item->elementLinkPage->page_id)
                <a href="{{ route("frontend.page", $item->elementLinkPage->page->slug) }}"></a>
            @endif

            @if ($item->elementLinkPage->is_custom_link)
                <a href="{{ $item->elementLinkPage->custom_link }}" {{ $item->elementLinkPage->is_external ? "target='_blank'" : ''}}></a>
            @endif
            
            <div class="overflow-hidden">
                <img class="w-full object-cover" src="{{ $item->getFirstMedia("laravel_block2_thumbnail")->getUrl() }}" alt="" />
            </div>
            @if ($item->title)
                <div class="relative mt-3 font-medium text-center text-black text-lg lg:text-xl">
                    <span class="inline-block relative product-thumbnail-title">
                        {{ $item->getTranslation("title", $locale) }}
                    </span>
                </div>
            @endif
        </div>
    @endforeach
</div>

@once
    @push('css')
        <style>
            .product-thumbnail a{
                position: absolute;
                display: block;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: 2;
            }
            .product-thumbnail .product-thumbnail-title::after{
                content: "";
                display: block;
                position: absolute;
                width: 100%;
                height: 2px;
                bottom: 0;
                left:0;
                border-bottom: 1px solid #aaa;
                transform: scaleX(0);
                transform-origin: left;
                transition-duration: 400ms;
            }

            .product-thumbnail img{
                -webkit-backface-visibility: hidden; 
                -ms-transform: translateZ(0); /* IE 9 */
                -webkit-transform: translateZ(0); /* Chrome, Safari, Opera */
                transform: translateZ(0);

                transform-origin: center center;
                transition: all .4s ease-in-out; 
            }

            @media (min-width:1024px) {
                .product-thumbnail:hover img{
                    transform: scale(1.1);
                }

                .product-thumbnail:hover .product-thumbnail-title::after{
                    transform: scaleX(1);
                }
            }
        </style>
    @endpush
@endonce
