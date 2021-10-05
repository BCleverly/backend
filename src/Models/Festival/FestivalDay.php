<?php

namespace BCleverly\Backend\Models\Festival;

use BCleverly\Backend\Database\Factories\Festival\FestivalDayFactory;
use BCleverly\Backend\Traits\HasMetaTags;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

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
