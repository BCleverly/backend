<?php

namespace BCleverly\Backend\Models;

use BCleverly\Backend\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use Spatie\Sluggable\HasTranslatableSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Tags\HasTags;

class Product extends Model implements \OwenIt\Auditing\Contracts\Auditable
{
    use HasFactory, HasTranslatableSlug, HasTranslations, HasTags, Auditable;

    protected $fillable = [
        'name',
        'sku',
        'price',
        'weight',
        'description',
        'body'
    ];

    protected $translatable = [
        'name',
        'slug',
        'description',
        'body'
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
                          ->generateSlugsFrom('name')
                          ->saveSlugsTo('slug');
    }
}
