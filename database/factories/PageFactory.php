<?php

namespace BCleverly\Backend\Database\Factories;

use BCleverly\Backend\Models\Page;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PageFactory extends Factory
{
    protected $model = Page::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'slug' => implode('/', $this->faker->words(random_int(0, 3))),
            'uuid' => Str::uuid(),
            'excerpt' => $this->faker->sentence,
            'author_id' => $this->faker->numberBetween(1, \App\Models\User::count()),
            'body' => $this->faker->sentences(10, true)
        ];
    }
}