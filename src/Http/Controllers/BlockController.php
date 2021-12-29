<?php

namespace GMJ\LaravelBlock2Thumbnail\Http\Controllers;

use App\Http\Controllers\Controller;
use Alert;
use App\Models\Element;
use GMJ\LaravelBlock2Thumbnail\Models\Block;
use GMJ\LaravelBlock2Thumbnail\Models\Config;

class BlockController extends Controller
{
    public function index($element_id)
    {
        $config = Config::where("element_id", $element_id)->first();
        if (!$config) {
            return redirect()->route("LaravelBlock2Thumbnail.config.create", $element_id);
        }

        $element = Element::findOrFail($element_id);
        $collections = Block::where("element_id", $element_id)->orderBy("display_order")->get();

        return view('LaravelBlock2Thumbnail::index', compact("element_id", "element", "collections"));
    }

    public function create($element_id)
    {
        $element = Element::findOrFail($element_id);
        $config = Config::where("element_id", $element_id)->first();
        return view('LaravelBlock2Thumbnail::create', compact("element_id", "element", "config"));
    }

    public function store($element_id)
    {
        $element = Element::findOrFail($element_id);

        $rules["uic_base64_image"] = "required";

        foreach (config("translatable.locales") as $locale) {
            $text[$locale] = request()["text_{$locale}"];
            $title[$locale] = request()["title_{$locale}"];
            $link_title[$locale] = request()["link_title_{$locale}"];
            $rules["text_{$locale}"] = "required";
        }

        request()->validate($rules);

        $display_order = Block::where("element_id", $element_id)->max("display_order");
        $display_order++;

        $collection = Block::create([
            "element_id" => $element_id,
            "title" => $title,
            "text" => $text,
            "display_order" => $display_order
        ]);

        $collection->addMediaFromBase64(request()->uic_base64_image, ["image/jpeg", "image/png"])->toMediaCollection('laravel_block2_thumbnail');

        if (request()->page_id) {
            $collection->link()->create([
                "element_id" => $element->id,
                "page_id" => request()->page_id,
                "title" => $link_title,
            ]);
        }

        $element->active();

        Alert::success("Add Element {$element->title} Thumbnail success");
        return redirect()->back();
    }

    public function edit($element_id, $id)
    {
        $element = Element::findOrFail($element_id);
        $collection = Block::findOrFail($id);
        $config = Config::where("element_id", $element_id)->first();
        return view('LaravelBlock2Thumbnail::edit', compact("element_id", "element", "collection", "config"));
    }

    public function update($element_id, $id)
    {
        $element = Element::findOrFail($element_id);

        foreach (config("translatable.locales") as $locale) {
            $text[$locale] = request()["text_{$locale}"];
            $title[$locale] = request()["title_{$locale}"];
            $link_title[$locale] = request()["link_title_{$locale}"];
            $rules["text_{$locale}"] = "required";
        }

        request()->validate($rules);
        $collection = Block::findOrFail($id);
        $collection->update([
            "title" => $title,
            "text" => $text,
        ]);

        if (request()->uic_base64_image) {
            $collection->addMediaFromBase64(request()->uic_base64_image, ["image/jpeg", "image/png"])->toMediaCollection('laravel_block2_thumbnail');
        }

        $collection->link()->delete();

        if (request()->page_id) {
            $collection->link()->create([
                "element_id" => $element->id,
                "page_id" => request()->page_id,
                "title" => $link_title,
            ]);
        }


        Alert::success("Edit Element {$element->title} Thumbnail success");
        return redirect()->route('LaravelBlock2Thumbnail.index', $element_id);
    }

    public function order($element_id)
    {
        $element = Element::find($element_id);
        $collections = Block::where("element_id", $element_id)->orderBy("display_order")->get();
        return view("LaravelBlock2Thumbnail::order", compact("element_id", "element", "collections"));
    }

    public function order2($element_id)
    {
        foreach (request()->id as $key => $item) {
            $collection = Block::find($item);
            $num = $key + 1;
            $collection->display_order = $num;
            $collection->save();
        }
        $element = Element::find($element_id);
        Alert::success("Edit Element {$element->title} Thumbnail Order success");
        return redirect()->route('LaravelBlock2Thumbnail.index', $element_id);
    }

    public function destroy($element_id, $id)
    {
        $element = Element::findOrFail($element_id);
        $collection = Block::findOrFail($id);
        $collection->link()->delete();
        $collection->delete();

        if ($collection->count() < 1) {
            $element->inactive();
        }
        Alert::success("Delete Element {$element->title} Thumbnail success");
        return redirect()->route('LaravelBlock2Thumbnail.index', $element_id);
    }
}
