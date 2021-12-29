<?php

namespace GMJ\LaravelBlock2Thumbnail\View\Components;

use GMJ\LaravelBlock2Thumbnail\Models\Block;
use GMJ\LaravelBlock2Thumbnail\Models\Config;
use Illuminate\View\Component;

class Frontend extends Component
{
    public $element_id;
    public $page_element_id;
    public $collections;

    public function __construct($pageElementId, $elementId)
    {
        $this->page_element_id = $pageElementId;
        $this->element_id = $elementId;
        $this->collections = Block::where("element_id", $elementId)->orderBy("display_order")->get();
    }

    public function render()
    {
        $config = Config::where("element_id", $this->element_id)->first();
        $layout = $config->layout;
        return view("LaravelBlock2Thumbnail::components.{$layout}.frontend");
    }
}
