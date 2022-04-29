<div class="laravel_block2_thumbnail lbt-col-{{ $layout }}">
    @foreach ($collection as $item)
        <div class="lbt-item">
            @if ($item->elementLinkPage->page_id)
                <a href="{{ route("frontend.page", $item->elementLinkPage->page->slug) }}"></a>
            @endif

            @if ($item->elementLinkPage->is_custom_link)
                <a href="{{ $item->elementLinkPage->custom_link }}" {{ $item->elementLinkPage->is_external ? "target='_blank'" : ''}}></a>
            @endif

            <figure class="lbt-gradient-line">
                <div class="overflow-hidden">
                    <img src="{{ $item->getFirstMedia("laravel_block2_thumbnail")->getUrl() }}" alt="">
                </div>
                @if ($item->title)     
                    <figcaption class="lbt-figcaption">
                        <span class="lbt-item-title">
                            {{ $item->getTranslation("title", $locale) }}
                        </span>
                    </figcaption>
                @endif
            </figure>
        </div>
    @endforeach
</div>

@once
    @push('css')
        <style>
            .laravel_block2_thumbnail{
                max-width: 1250px;
                padding: 0 1.25rem;
                display: grid;
                max-width: max-content;
                margin: 30px auto 0;
                gap: 1.75rem;
            }

            .laravel_block2_thumbnail.lbt-col-1,
            .laravel_block2_thumbnail.lbt-col-2,
            .laravel_block2_thumbnail.lbt-col-3{
                grid-template-columns: 1fr;
            }

            .laravel_block2_thumbnail .lbt-item{
                position: relative;
                cursor: pointer;
            }
            .laravel_block2_thumbnail .lbt-gradient-line::after{
                content: "";
                display: block;
                position: absolute;
                top: 0;
                left:0;
                width: 100%;
                height: 100%;
                background: -webkit-gradient(linear, left top, left bottom, color-stop(70%, rgba(0, 0, 0, 0)), to(rgba(0, 0, 0, 0.6)));
                background: -webkit-linear-gradient(rgba(0, 0, 0, 0) 70%, rgba(0, 0, 0, 0.6));
                background: linear-gradient(rgba(0, 0, 0, 0) 70%, rgba(0, 0, 0, 0.6));
            }

            .laravel_block2_thumbnail .lbt-figcaption {
                position: absolute;
                width: 100%;
                bottom: 1rem;
                font-size: clamp(16px, 2vw, 24px);
                font-weight: 600;
                text-align: center;
                color:white;
                z-index: 1
            }

            .laravel_block2_thumbnail .lbt-item-title{
                position: relative;
                display: inline-block;
            }
            .laravel_block2_thumbnail .lbt-item-title::after{
                content: "";
                display: block;
                position: absolute;
                width: 100%;
                height: 1px;
                bottom: 0;
                left:0;
                border-top: 1px solid #aaa;
                transform: scaleX(0);
                transform-origin: left;
                transition-duration: 400ms;
            }

            .laravel_block2_thumbnail .lbt-item a{
                position: absolute;
                display: block;
                top: 0;
                left: 0;
                width:100%;
                height: 100%;
                z-index: 2;
            }

            @media (min-width:768px) {
                .laravel_block2_thumbnail{
                    gap: 2rem;
                    padding: 0 2rem;
                    max-width: 1250px;
                    margin: 50px auto 0;
                }

                .laravel_block2_thumbnail.lbt-col-2,
                .laravel_block2_thumbnail.lbt-col-3{
                    grid-template-columns: repeat(2, 1fr);
                }
                .laravel_block2_thumbnail .lbt-figcaption {
                    position: relative;
                    bottom: 0;
                    margin-top: 0.75rem;
                    color: #222;
                }
                .laravel_block2_thumbnail .lbt-gradient-line::after{
                    display:none;
                }
            }

            @media (min-width:1024px) {
                .laravel_block2_thumbnail{
                    gap: 2.25rem;
                }
                .laravel_block2_thumbnail.lbt-col-3{
                    grid-template-columns: repeat(3, 1fr);
                }

                .laravel_block2_thumbnail .lbt-item:hover .lbt-item-title::after{
                    transform: scaleX(1);
                }
                .laravel_block2_thumbnail .lbt-item img{
                    transition: transform 0.6s;
                }
                .laravel_block2_thumbnail .lbt-item:hover img{
                    transform: scale(1.05);
                }
  
            }
        </style>
    @endpush
@endonce