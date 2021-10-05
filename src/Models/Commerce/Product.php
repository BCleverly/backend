<?php

namespace BCleverly\Backend\Models\Commerce;

use BCleverly\Backend\Database\Factories\Commerce\ProductFactory;
use BCleverly\Backend\Traits\{HasTags};
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Product extends Model implements \OwenIt\Auditing\Contracts\Auditable
{
    use HasFactory, HasSlug, Auditable, HasTags;

    protected $fillable = [
        'name',
    ];

    protected $with = ['tags'];

    protected static function newFactory(): ProductFactory
    {
        return ProductFactory::new();
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
}
