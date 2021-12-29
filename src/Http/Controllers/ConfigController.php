<?php

namespace GMJ\LaravelBlock2Thumbnail\Http\Controllers;

use App\Http\Controllers\Controller;
use Alert;
use App\Models\Element;
use GMJ\LaravelBlock2Thumbnail\Models\Config;

class ConfigController extends Controller
{
    public function create($element_id)
    {
        $element = Element::findOrFail($element_id);
        return view('LaravelBlock2Thumbnail.config::create', compact("element_id", "element"));
    }

    public function store($element_id)
    {
        $element = Element::findOrFail($element_id);

        request()->validate([
            "img_width" => ["required", "integer"],
            "img_height" => ["required", "integer"],
            "layout" => ["required"],
        ]);

        Config::create([
            "element_id" => $element->id,
            "img_width" => request()->img_width,
            "img_height" => request()->img_height,
            "layout" => request()->layout,
            /* "is_slider" => request()->is_slider ? 1 : 0, */
        ]);

        Alert::success("Add Element {$element->title} Thumbnail Config success");
        return redirect()->route("LaravelBlock2Thumbnail.index", $element_id);
    }

    public function edit($element_id)
    {
        $element = Element::findOrFail($element_id);
        $collection = Config::where("element_id", $element_id)->first();
        return view('LaravelBlock2Thumbnail.config::edit', compact("element_id", "element", "collection"));
    }

    public function update($element_id)
    {

        $element = Element::findOrFail($element_id);

        request()->validate([
            "img_width" => ["required", "integer"],
            "img_height" => ["required", "integer"],
            "layout" => ["required"],
        ]);

        $config = Config::where("element_id", $element_id);

        $config->update([
            "img_width" => request()->img_width,
            "img_height" => request()->img_height,
            "layout" => request()->layout,
            /* "is_slider" => request()->is_slider ? 1 : 0, */
        ]);

        Alert::success("Edit Element {$element->title} Thumbnail Config success");
        return redirect()->route("LaravelBlock2Thumbnail.index", $element_id);
    }
}
