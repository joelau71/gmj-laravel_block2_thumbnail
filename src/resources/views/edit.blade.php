<x-admin.layout.app>
    @php
    $breadcrumbs = [
        ['name' => 'Element', 'link' => route("admin.element.index")],
        ['name' => $element->title],
        ['name' => "Thumbnail", "link" => route('LaravelBlock2Thumbnail.index', $element->id)],
        ['name' => "Edit"]
    ];
    @endphp
    <x-admin.atoms.breadcrumb :breadcrumbs="$breadcrumbs" />

    <form
        class="relative mt-7"
        method="POST"
        action="{{ route("LaravelBlock2Thumbnail.update", ["element_id" => $element->id, "id" => $collection->id]) }}"
    >
        @csrf
        @method("patch")
        <x-admin.atoms.required />

        <x-admin.atoms.row>
            <x-admin.atoms.label class="required mb-2">
                Image ({{ $config->img_width }} x {{ $config->img_height }}) (only accept jpg, png)
            </x-admin.atoms.label>
            <input
                type="file"
                name="image"
                id="image"
                class="upload-image-copper"
                data-uic-display-width="{{ $config->img_width }}"
                data-uic-display-height="{{ $config->img_height }}"
                data-uic-target-width="{{ $config->img_width }}"
                data-uic-target-height="{{ $config->img_height }}"
                data-uic-title="Size: {{ $config->img_width }}(w) x {{ $config->img_height }}(h)"
                data-uic-path="{{ $collection->getMedia('laravel_block2_thumbnail')->first()->getUrl() }}"
            />
            @error("uic_base64_image")
                <x-admin.atoms.error>
                    {{ $message }}
                </x-admin.atoms.error>
            @enderror
        </x-admin.atoms.row>

        @foreach (config('translatable.locales') as $locale)
            <x-admin.atoms.row>
                <x-admin.atoms.label for="title_{{ $locale }}">
                    Title ({{ $locale }})
                </x-admin.atoms.label>
                <x-admin.atoms.text
                    name="title_{{$locale}}"
                    id="title_{{$locale}}"
                    value="{{ $collection->getTranslation('title', $locale) }}"
                />
            </x-admin.atoms.row>
        @endforeach

        @foreach (config('translatable.locales') as $locale)
            <x-admin.atoms.row>
                <x-admin.atoms.label class="required">
                    Text ({{ $locale }})
                </x-admin.atoms.label>
                <x-admin.atoms.textarea name="text_{{ $locale }}" id="text_{{ $locale }}">{{ $collection->getTranslation('text', $locale) }}</x-admin.atoms.textarea>
            </x-admin.atoms.row>
            @error("text_{$locale}")
                <x-admin.atoms.error>
                    {{ $message }}
                </x-admin.atoms.error>
            @enderror
        @endforeach

        <x-admin.atoms.row>

        <x-admin.atoms.page
            can_null
            link_id="{{ $collection->link()->exists() ? $collection->link->id : ''}}"
        />

        </x-admin.atoms.row>

        <hr class="my-10">

        <div class="text-right">
            <x-admin.atoms.link
                href="{{ url()->previous() }}"
            >
                Back
            </x-admin.atoms.link>
            <x-admin.atoms.button id="save">
                Save
            </x-admin.atoms.button>
        </div>

    </form>
</x-admin.layout.app>
