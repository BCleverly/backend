<?php

namespace BCleverly\Backend\Models;

use BCleverly\Backend\Database\Factories\MetaTagFactory;
use Illuminate\Database\Eloquent\{Factories\HasFactory, Model, Relations\BelongsTo};
use OwenIt\Auditing\Auditable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MetaTag extends Model implements \OwenIt\Auditing\Contracts\Auditable, HasMedia
{
    use HasFactory, \OwenIt\Auditing\Auditable, InteractsWithMedia;

    protected $with = [
        'media'
    ];

    protected $fillable = [
        'page_id',
        'title',
        'description',
        'image',
    ];

    protected static function newFactory(): MetaTagFactory
    {
        return MetaTagFactory::new();
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('hero')
            ->singleFile()
            ->registerMediaConversions(function (Media $media) {

                $this->addMediaConversion('thumb')
                     ->width(360)
                     ->height(360)
                     ->sharpen(5);

                $this->addMediaConversion('facebook')
                     ->width(1200)
                     ->height(630)
                     ->sharpen(5);

                $this->addMediaConversion('twitter')
                     ->width(1200)
                     ->sharpen(5);
            });
    }

    public function registerMediaConversions(Media $media = null): void
    {
    }

    public function metaTaggable()
    {
        return $this->morphTo();
    }
}
