<?php

namespace BCleverly\Backend\Models;

use BCleverly\Backend\Database\Factories\BlogPostFactory;
use BCleverly\Backend\Traits\{HasTags, HasTranslations, HasAverageReadingTime};
use Illuminate\Database\Eloquent\{Factories\HasFactory, Model, Relations\BelongsTo, SoftDeletes, Builder};
use OwenIt\Auditing\Auditable;

class BlogPost extends Model implements \OwenIt\Auditing\Contracts\Auditable
{
    use HasFactory, SoftDeletes, HasTranslations, Auditable, HasTags, HasAverageReadingTime;

    protected $fillable = [
        'name',
        'author_id',
        'slug',
        'description',
        'body'
    ];

    protected $translatable = [
        'name',
        'slug',
        'description',
        'body'
    ];

    protected $with = ['tags'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(config('backend.database.table_names.blog_post'));
    }

    protected static function newFactory(): BlogPostFactory
    {
        return BlogPostFactory::new();
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

    public function author(): BelongsTo
    {
        return $this->belongsTo(config('backend.user_class'), 'author_id', 'id');
    }

    public function isPublished(): mixed
    {
        return $this->attributes['publish_at']?->diffForHumans() ?? false;
    }
}
