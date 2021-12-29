<?php

namespace Database\Seeders;

use App\Models\Element;
use App\Models\ElementTemplate;
use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Models\Page;
use GMJ\LaravelBlock2Thumbnail\Models\Block;
use GMJ\LaravelBlock2Thumbnail\Models\Config;
use Illuminate\Support\Arr;
use Image;

class LaravelBlock2ThumbnailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $template = ElementTemplate::where("component", "LaravelBlock2Thumbnail")->first();

        if ($template) {
            return false;
        }

        $template = ElementTemplate::create(
            [
                "title" => "Laravel Block2 Thumbnail",
                "component" => "LaravelBlock2Thumbnail",
            ]
        );
        $element = Element::create([
            "template_id" => $template->id,
            "title" => "laravel-block2-thumbnail-sample",
            "is_active" => 1
        ]);
        $faker = Factory::create();
        $pages = Page::orderBy("id")->pluck("id")->toArray();

        $config = Config::create([
            "element_id" => $element->id,
            "img_width" => "600",
            "img_height" => "600",
            "layout" => "4-column",
        ]);

        for ($i = 1; $i < 9; $i++) {
            $title = [];
            $text = [];

            foreach (config('translatable.locales') as $locale) {
                $title[$locale] = $faker->name;
                $text[$locale] = $faker->text(60);
                $link_title[$locale] = $faker->name;
            }

            $collection = Block::create([
                "element_id" => $element->id,
                "title" => $title,
                "text" => $text,
                "display_order" => $i
            ]);

            $img = Image::make(storage_path("demo/people/{$i}.jpg"))->fit($config->img_width, $config->img_height);

            $img->save(storage_path("demo/temp.jpg"));
            $collection->addMedia(storage_path('demo/temp.jpg'))
                ->toMediaCollection("laravel_block2_thumbnail");
            $page_id = Arr::random($pages);

            $collection->link()->create([
                "element_id" => $element->id,
                "page_id" => $page_id,
                "title" => $link_title,
            ]);
        }
    }
}
