<?php

namespace BCleverly\Backend\Models\Festival;

use BCleverly\Backend\Database\Factories\Festival\FestivalDayFactory;
use BCleverly\Backend\Traits\HasMetaTags;
use Illuminate\Database\Eloquent\{Factories\HasFactory, Model, Relations\BelongsToMany, Relations\HasManyThrough, SoftDeletes};
use Laravel\Scout\Searchable;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\MediaLibrary\{HasMedia, InteractsWithMedia};
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\{HasSlug, SlugOptions};

class FestivalDay extends Model implements Auditable, HasMedia
{
    use HasFactory, SoftDeletes, \OwenIt\Auditing\Auditable, InteractsWithMedia, HasSlug, HasMetaTags, Searchable;

    protected $fillable = [
        'name',
        'uuid',
        'description',
        'body',
        'slug',
    ];

    protected $with = ['media'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(config('backend.database.table_names.festival_day'));
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
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

    /**
     * @return FestivalDayFactory
     */
    protected static function newFactory(): FestivalDayFactory
    {
        return FestivalDayFactory::new();
    }

    public function stages(): BelongsToMany
    {
        return $this->belongsToMany(
            FestivalStage::class,
            config('backend.database.table_names.festival_day_stage'),
            'festival_day_id',
            'festival_stage_id'
        )->withPivot(['order']);
    }
}
