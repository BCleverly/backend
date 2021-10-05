<?php

namespace BCleverly\Backend\Models\Festival;

use BCleverly\Backend\Database\Factories\Festival\FestivalDayFactory;
use BCleverly\Backend\Database\Factories\Festival\FestivalStageFactory;
use BCleverly\Backend\Traits\HasMetaTags;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class FestivalStage extends Model implements Auditable, HasMedia
{
    use HasFactory, SoftDeletes, \OwenIt\Auditing\Auditable, InteractsWithMedia, HasMetaTags, Searchable;

    protected $fillable = [
        'name',
        'uuid',
        'description',
        'body',
    ];

    protected $with = ['media'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(config('backend.database.table_names.festival_stage'));
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

    protected static function newFactory(): FestivalStageFactory
    {
        return FestivalStageFactory::new();
    }

    public function days(): BelongsToMany
    {
        return $this->belongsToMany(
            FestivalDay::class,
            config('backend.database.table_names.festival_day_stage'),
            'festival_stage_id',
            'festival_day_id'
        )->withPivot(['order']);
    }

    public function performers(): BelongsToMany
    {
        return $this->belongsToMany(
            FestivalPerformer::class,
            config('backend.database.table_names.festival_stage_performer'),
            'festival_stage_id',
            'festival_performer_id'
        )->withPivot(['performance_time', 'headliner']);
    }
}
