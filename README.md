# gmj-laravel_block2_thumbnail

Laravel Block for backend and frontend - need tailwindcss support

**composer require gmj/laravel_block2_thumbnail**

in terminal run:

```
php artisan vendor:publish --provider="GMJ\LaravelBlock2Thumbnail\LaravelBlock2ThumbnailServiceProvider" --force
php artisan migrate
php artisan db:seed --class=LaravelBlock2ThumbnailSeeder
```

package for test<br>
composer.json#autoload-dev#psr-4: "GMJ\\LaravelBlock2Thumbnail\\": "package/laravel_block2_thumbnail/src/",<br>
config: GMJ\LaravelBlock2Thumbnail\LaravelBlock2ThumbnailServiceProvider::class,
