<?php

namespace GMJ\LaravelBlock2Thumbnail\Models;

use App\Traits\DeleteAllChildrenTrait;
use App\Traits\DeleteElementLinkPageTrait;
use App\Traits\ElementLinkPageTrait;
use App\Traits\GrabImageFromUnsplashTrait;
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
    use ElementLinkPageTrait;
    use DeleteAllChildrenTrait;
    use GrabImageFromUnsplashTrait;
    use DeleteElementLinkPageTrait;

    protected $guarded = [];
    public $translatable = ['title'];
    public $table = "laravel_block2_thumbnails";

    public function registerMediaCollections(Media $media = null): void
    {
        $this->addMediaCollection("laravel_block2_thumbnail")
            ->singleFile();

        $this->addMediaCollection("laravel_block2_thumbnail_original")
            ->singleFile();
    }
}
