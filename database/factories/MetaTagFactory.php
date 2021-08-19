<?php

namespace BCleverly\Backend\Database\Factories;

use BCleverly\Backend\Models\MetaTag;
use Illuminate\Database\Eloquent\Factories\Factory;

class MetaTagFactory extends Factory
{
    protected $model = MetaTag::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->sentence,
            'image' => $this->faker->imageUrl
        ];
    }
}
