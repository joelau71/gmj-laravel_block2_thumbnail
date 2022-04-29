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
        $imageSubject = "person";
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
            "img_width" => "800",
            "img_height" => "600",
            "layout" => 3,
        ]);

        for ($i = 1; $i < 9; $i++) {
            $title = [];

            foreach (config('translatable.locales') as $locale) {
                $title[$locale] = $faker->name;
            }

            $collection = Block::create([
                "element_id" => $element->id,
                "title" => $title,
                "display_order" => $i
            ]);

            $url = "https://source.unsplash.com/{$config->img_width}x{$config->img_height}/?{$imageSubject}";
            $path = "demo/temp.jpg";

            $collection->grabImageFromUnsplash($url, $path);

            $collection->addMedia(storage_path($path))
                ->preservingOriginal()
                ->toMediaCollection("laravel_block2_thumbnail_original");

            $collection->addMedia(storage_path($path))->withResponsiveImages()
                ->toMediaCollection("laravel_block2_thumbnail");

            $page_id = Arr::random($pages);

            $collection->elementLinkPage()->create([
                "element_id" => $element->id,
                "page_id" => $page_id,
            ]);
        }

        $element = Element::create([
            "template_id" => $template->id,
            "title" => "laravel-block2-thumbnail-sample-3-product",
            "is_active" => 1
        ]);

        $config = Config::create([
            "element_id" => $element->id,
            "img_width" => "316",
            "img_height" => "226",
            "layout" => "3-product",
        ]);

        for ($i = 1; $i < 9; $i++) {
            $title = [];

            foreach (config('translatable.locales') as $locale) {
                $title[$locale] = $faker->name;
            }

            $collection = Block::create([
                "element_id" => $element->id,
                "title" => $title,
                "display_order" => $i
            ]);

            $url = "https://source.unsplash.com/{$config->img_width}x{$config->img_height}/?{$imageSubject}";
            $path = "demo/temp.jpg";

            $collection->grabImageFromUnsplash($url, $path);

            $collection->addMedia(storage_path($path))
                ->preservingOriginal()
                ->toMediaCollection("laravel_block2_thumbnail_original");

            $collection->addMedia(storage_path($path))->toMediaCollection("laravel_block2_thumbnail");

            $page_id = Arr::random($pages);

            $collection->elementLinkPage()->create([
                "element_id" => $element->id,
                "page_id" => $page_id,
            ]);
        }
    }
}
