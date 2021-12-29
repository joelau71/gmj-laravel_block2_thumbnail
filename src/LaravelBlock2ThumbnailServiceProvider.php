<?php

namespace GMJ\LaravelBlock2Thumbnail;

use GMJ\LaravelBlock2Thumbnail\View\Components\Frontend;
use GMJ\LaravelBlock2Thumbnail\View\Components\Item;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class LaravelBlock2ThumbnailServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->loadRoutesFrom(__DIR__ . "/routes/web.php", 'LaravelBlock2Thumbnail');
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'LaravelBlock2Thumbnail');
        $this->loadViewsFrom(__DIR__ . '/resources/views/config', 'LaravelBlock2Thumbnail.config');

        Blade::component("LaravelBlock2Thumbnail", Frontend::class);
        Blade::component("LaravelBlock2ThumbnailItem", Item::class);

        $this->publishes([
            __DIR__ . '/config/laravel_block2_thumbnail_config.php' => config_path('gmj/laravel_block2_thumbnail_config.php'),
            __DIR__ . '/database/seeders' => database_path('seeders'),
        ], 'GMJ\LaravelBlock2Thumbnail');
    }


    public function register()
    {
    }
}
