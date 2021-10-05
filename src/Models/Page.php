<?php

namespace BCleverly\Backend\Models;

use BCleverly\Backend\Database\Factories\PageFactory;
use BCleverly\Backend\Traits\HasAverageReadingTime;
use BCleverly\Backend\Traits\HasMetaTags;
use BCleverly\Backend\Traits\HasTags;
use BCleverly\Backend\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Page extends Model implements Auditable, HasMedia
{
    use HasFactory, SoftDeletes, \OwenIt\Auditing\Auditable, HasTags, HasAverageReadingTime, InteractsWithMedia, HasMetaTags, Searchable;

    protected $fillable = [
        'name',
        'parent_id',
        'author_id',
        'slug',
        'description',
        'body',
        'publish_at',
        'un_publish_at',
    ];

    protected $with = ['tags', 'metaTag', 'media', 'parent'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(config('backend.database.table_names.page'));
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

    protected static function newFactory(): PageFactory
    {
        return PageFactory::new();
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

//    public function getRouteKeyName():string
//    {
//        return 'slug';
//    }

    public function scopeType($query, string $type = ''): Builder
    {
        return $query->where('type', $type);
    }

    public function scopePage($query): Builder
    {
        return $this->scopeType($query, 'page');
    }

    public function scopeBlog($query): Builder
    {
        return $this->scopeType($query, 'blog');
    }

    public function getEditUrl(): string
    {
        return route('dashboard.page.edit', $this);
    }

    public function getUpdateUrl(): string
    {
        return route('dashboard.page.update', $this);
    }

    public function parent(): HasOne
    {
        return $this->hasOne(self::class, 'id', 'parent_id');
    }

    public function child(): HasOne
    {
        return $this->hasOne(self::class, 'parent_id', 'id');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(config('backend.user_class'), 'author_id', 'id');
    }

    public function isPublished(): mixed
    {
        return $this->attributes['publish_at']?->diffForHumans() ?? false;
    }
}
