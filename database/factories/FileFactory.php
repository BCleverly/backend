<?php

namespace BCleverly\Backend\Database\Factories;

use BCleverly\Backend\Models\Page;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class FileFactory extends Factory
{
    protected $model = Page::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'uuid' => Str::uuid(),
            'description' => $this->faker->sentence,
        ];
    }
}
