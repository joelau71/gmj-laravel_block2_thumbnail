<x-frontend.container>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 mt-20 justify-items-center laravel-block2-thumbnail-latest-new">
        @foreach ($collection as $item)
            <div class="relative bg-gray-100" style="min-height: 500px; max-width:328px">
                <div>
                    @isset ($item->elementLinkPage)
                        @if ($item->elementLinkPage->is_custom_link)
                            <a href="{{ $item->elementLinkPage->custom_link }}" class="block hover:opacity-60" {{ $item->elementLinkPage->is_external ? "target='_blank'" : ""}}>
                        @else
                            <a href="{{ route('frontend.page', $item->elementLinkPage->page->slug) }}" class="block hover:opacity-60">
                        @endif
                    @endisset
                        <img src="{{ $item->getFirstMedia("laravel_block2_thumbnail")->getUrl() }}" alt="">
                    @isset ($item->elementLinkPage)
                        </a>
                    @endisset

                </div>
                <p class="p-6 text-xl font-semibold">
                    {{ $item->getTranslation("title", $locale) }}
                </p>

                @isset ($item->elementLinkPage)
                    @if ($item->elementLinkPage->is_custom_link)
                        <a href="{{ $item->elementLinkPage->custom_link }}" class="absolute w-10 h-10 bottom-0 right-0 flex items-center justify-center bg-blue-800 text-white hover:bg-blue-600" {{ $item->elementLinkPage->is_external ? "target='_blank'" : ""}}>
                    @else
                        <a href="{{ route('frontend.page', $item->elementLinkPage->page->slug) }}" class="absolute w-10 h-10 bottom-0 right-0 flex items-center justify-center bg-blue-800 text-white hover:bg-blue-600">
                    @endif
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                    </a>
                @endisset
            </div>
        @endforeach
    </div>
</x-frontend.container>