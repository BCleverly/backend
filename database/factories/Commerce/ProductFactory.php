<?php

namespace BCleverly\Backend\Database\Factories\Commerce;

use BCleverly\Backend\Models\Commerce\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
        ];
    }
}
