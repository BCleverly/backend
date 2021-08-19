<?php

namespace BCleverly\Backend\Models\Commerce;

use BCleverly\Backend\Database\Factories\Commerce\ProductOptionsFactory;
use BCleverly\Backend\Database\Factories\Commerce\ProductOptionValuesFactory;
use Illuminate\Database\Eloquent\{Factories\HasFactory, Model};

class ProductOptionValues extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'product_option_id',
        'name',
    ];

    protected $with = ['tags'];

    protected static function newFactory(): ProductOptionValuesFactory
    {
        return ProductOptionValuesFactory::new();
    }
}
