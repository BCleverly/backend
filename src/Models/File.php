<?php

namespace BCleverly\Backend\Models;

use BCleverly\Backend\Database\Factories\FileFactory;
use BCleverly\Backend\Traits\{HasTags};
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class File extends Model implements \OwenIt\Auditing\Contracts\Auditable, HasMedia
{
    use HasFactory, SoftDeletes, Auditable, HasTags, InteractsWithMedia;

    protected $fillable = [
        'name',
        'description',
        'path',
    ];

    protected $with = ['tags', 'media'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('heroImage')
             ->registerMediaConversions(function (Media $media) {
                 $this->addMediaConversion('thumb')
                      ->width(368)
                      ->height(232)
                      ->sharpen(10);
             });
    }

    protected static function newFactory(): FileFactory
    {
        return FileFactory::new();
    }
}
