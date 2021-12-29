<div class="px-4 h-full mx-auto">
    <div class="relative flex flex-col h-full border border-gray-100 transform duration-500 hover:shadow-lg">
        <div class="text-center overflow-hidden">
            <img src="{{ $content->getMedia("laravel_block2_thumbnail")->first()->getUrl() }}" alt="" class="w-full inline-block">
        </div>
        <div class="flex-1 flex flex-col p-4">
            <h3 class="text-xl">
                {{ $content->getTranslation("title", $locale) }}
            </h3>
            <div class="flex-1">
                {{ $content->getTranslation("text",  $locale) }}
            </div>
            @if ($content->link)
                <div class="mt-4 text-right text-white">
                    <a href="{{ route("frontend.page", $content->link->page->slug) }}" class="inline-block px-4 py-1 main-bg-color rounded-md">
                        {{ $content->link->title ? $content->link->getTranslation("title", $locale) : $content->link->page->title }}
                    </a> 
                </div>
            @endif
        </div>
    </div>
</div>