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
            'name'      => $this->faker->name,
            'slug'      => implode('/', $this->faker->words(random_int(0, 3))),
            'uuid'      => Str::uuid(),
            'excerpt'   => $this->faker->sentence,
            'author_id' => $this->faker->numberBetween(1, \App\Models\User::count()),
            'body'      => '{"time":1629646555185,"blocks":[{"id":"oPpXIDM_IG","type":"header","data":{"text":"hello world","level":1}}],"version":"2.22.2"}',
        ];
    }

    public function homepage()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'homepage',
                'slug' => 'homepage',
                'type' => 'page',
                'body' => '{"time":1635089385198,"blocks":[{"id":"7VvJ_64zEv","type":"header","data":{"text":"Hey I\'m Ben","level":1}},{"id":"TX4xBrMoXi","type":"paragraph","data":{"text":"I currently work as a Senior Web Developer for an e-commerce company and head up the website team."}},{"id":"_QySFcajIU","type":"paragraph","data":{"text":"I have worked at agencies big and small, on websites and apps for small local business all the way up to global companies."}},{"id":"ik8Dk_XNTc","type":"paragraph","data":{"text":"In my spare time I enjoy cooking, playing games, and building/paging Warhammer 40k."}},{"id":"wtIjA2SDyQ","type":"paragraph","data":{"text":"This is a small portfolio and <a href=\"https://bencleverly.me/blog\">my ramblings</a> and/or problem solving so I can come back to it in the future."}}],"version":"2.22.2"}'
            ];
        });
    }

    public function blogPost(string $name = '')
    {
        return $this->state(function (array $attributes) use ($name) {
            return [
                'name' => $name,
                'slug' => 'blog/' . Str::slug($name),
                'type' => 'blog',
            ];
        });
    }
}
