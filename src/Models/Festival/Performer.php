<?php

namespace BCleverly\Backend\Models\Festival;

use BCleverly\Backend\Database\Factories\Festival\PerformerFactory;
use BCleverly\Backend\Traits\HasMetaTags;
use Illuminate\Database\Eloquent\{Factories\HasFactory, Model, Relations\BelongsToMany, SoftDeletes};
use Laravel\Scout\Searchable;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\MediaLibrary\{HasMedia, InteractsWithMedia};
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\{HasSlug, SlugOptions};

class Performer extends Model implements Auditable, HasMedia
{
    use HasFactory, SoftDeletes, \OwenIt\Auditing\Auditable, InteractsWithMedia, HasSlug, HasMetaTags, Searchable;

    protected $fillable = [
        'name',
        'body',
        'slug',
    ];

    protected $with = ['metaTag', 'media'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(config('backend.database.table_names.performer'));
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
                          ->generateSlugsFrom('name')
                          ->saveSlugsTo('slug');
    }

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

    protected static function newFactory(): PerformerFactory
    {
        return PerformerFactory::new();
    }

    public function isPublished(): mixed
    {
        return $this->attributes['publish_at']?->diffForHumans() ?? false;
    }

    public function festivals(): BelongsToMany
    {
        return $this->belongsToMany(Festival::class)->withPivot('day', 'time', 'stage_name', 'headline');
    }
}
