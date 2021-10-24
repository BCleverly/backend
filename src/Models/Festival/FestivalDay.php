<?php

namespace BCleverly\Backend\Models\Festival;

use BCleverly\Backend\Database\Factories\Festival\FestivalDayFactory;
use BCleverly\Backend\Traits\HasMetaTags;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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

    protected $with = ['media', 'metaTag'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(config('backend.database.table_names.festival_day'));
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('author', function (Builder $builder) {
            if (auth()->check() && auth()->user()->hasRole('SuperAdmin') === false) {
                $builder->where('author_id', auth()->user()->id);
            }
        });
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

    public function performers(): BelongsToMany
    {
        return $this->belongsToMany(
            FestivalPerformer::class,
            config('backend.database.table_names.festival_day_performer'),
            'festival_day_id',
            'festival_performer_id'
        )->withPivot(['time', 'headline', 'stage']);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(config('backend.user_class'), 'author_id', 'id');
    }
}
