<?php

namespace GMJ\LaravelBlock2Thumbnail\View\Components;

use App\Traits\LocaleTrait;
use GMJ\LaravelBlock2Thumbnail\Models\Block;
use GMJ\LaravelBlock2Thumbnail\Models\Config;
use Illuminate\View\Component;

class Frontend extends Component
{
    use LocaleTrait;

    public $element_id;
    public $page_element_id;
    public $collection;
    public $layout;
    public $locale;
    public $config;

    public function __construct($pageElementId, $elementId)
    {
        $this->page_element_id = $pageElementId;
        $this->element_id = $elementId;
        $this->collection = Block::with("media")->with("elementLinkPage", function ($query) {
            $query->with("page");
        })->where("element_id", $elementId)->orderBy("display_order")->get();
        $this->config = Config::where("element_id", $this->element_id)->first();
        $this->locale = $this->getLocale();
        $this->layout = $this->config->layout;
    }

    public function render()
    {
        return view("LaravelBlock2Thumbnail::components.frontend-{$this->layout}");
    }
}
