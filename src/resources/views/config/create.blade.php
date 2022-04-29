<x-admin.layout.app>
    @php
    $breadcrumbs = [
        ['name' => 'Element', 'link' => route("admin.element.index")],
        ['name' => $element->title],
        ['name' => "Thumbnail", "link" => route('LaravelBlock2Thumbnail.index', $element->id)],
        ['name' => "Config Create"]
    ];
    @endphp
    <x-admin.atoms.breadcrumb :breadcrumbs="$breadcrumbs" />

    <form
        class="relative mt-7"
        method="POST"
        action="{{ route("LaravelBlock2Thumbnail.config.store", $element->id) }}"
        x-data="{layout: ''}"
        x-init="$watch('layout', value => {
            if (value == 1) {
                $refs.imageWidth.value = '1250';
            }
            if (value == 1) {
                $refs.imageHeight.value = '490';
            }
            if (value == 2 || value == 3) {
                $refs.imageWidth.value = '625';
            }
            if (value == 2 || value == 3) {
                $refs.imageHeight.value = '416';
            }
            if (value == '3-product') {
                $refs.imageWidth.value = '316';
                $refs.imageHeight.value = '226';
            }
            if (value == 'latest-news') {
                $refs.imageWidth.value = '328';
                $refs.imageHeight.value = '256';
            }
        })"
    >
        @csrf
        <x-admin.atoms.required />

        <x-admin.atoms.row>
            <x-admin.atoms.label for="layout" class="required">
                Layout
            </x-admin.atoms.label>
            <x-admin.atoms.select
                name="layout"
                id="layout"
                x-model="layout"
            >
                <option value="">--Select Item--</option>
                @foreach (config("gmj.laravel_block2_thumbnail_config.layouts") as $item)
                    <option value="{{ $item }}">{{ $item }}</option>
                @endforeach 
            </x-admin.atoms.select>
            @error("layout")
                <x-admin.atoms.error>
                    {{ $message }}
                </x-admin.atoms.error>
            @enderror
        </x-admin.atoms.row>

        <x-admin.atoms.row>
            <x-admin.atoms.label for="img_width" class="required">
                Image Width
            </x-admin.atoms.label>
            <x-admin.atoms.text name="img_width" id="img_width" x-ref="imageWidth" />
            @error("img_width")
                <x-admin.atoms.error>
                    {{ $message }}
                </x-admin.atoms.error>
            @enderror
        </x-admin.atoms.row>

        <x-admin.atoms.row>
            <x-admin.atoms.label for="img_height" class="required">
                Image Height
            </x-admin.atoms.label>
            <x-admin.atoms.text name="img_height" id="img_height" x-ref="imageHeight" />
            @error("img_height")
                <x-admin.atoms.error>
                    {{ $message }}
                </x-admin.atoms.error>
            @enderror
        </x-admin.atoms.row>

        <hr class="my-10">

        <div class="text-right">
            <x-admin.atoms.link
                href="{{ route('LaravelBlock2Thumbnail.index', $element->id) }}"
            >
                Back
            </x-admin.atoms.link>
            <x-admin.atoms.button id="save">
                Save
            </x-admin.atoms.button>
        </div>
    </form>
</x-admin.layout.app>
