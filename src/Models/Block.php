<?php

namespace GMJ\LaravelBlock2Thumbnail\Models;

use App\Models\Link;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Block extends Model implements HasMedia
{
    use HasFactory;
    use HasTranslations;
    use InteractsWithMedia;

    protected $guarded = [];
    public $translatable = ['title', 'text'];
    public $table = "laravel_block2_thumbnails";

    public function registerMediaCollections(Media $media = null): void
    {
        $this->addMediaCollection("laravel_block2_thumbnail")
            ->singleFile();
    }

    public function link()
    {
        return $this->morphOne(Link::class, 'linkable');
    }
}
