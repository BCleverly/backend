<?php

namespace BCleverly\Backend\Models\Commerce;

use BCleverly\Backend\Database\Factories\Commerce\ProductOptionsFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOptions extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'name',
    ];

    protected $with = ['tags'];

    protected static function newFactory(): ProductOptionsFactory
    {
        return ProductOptionsFactory::new();
    }
}
