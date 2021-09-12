<?php

namespace BCleverly\Backend\Database\Factories\Festival;

use BCleverly\Backend\Models\Festival\Festival;

use BCleverly\Backend\Models\Festival\Performer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PerformerFactory extends Factory
{
    protected $model = Performer::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'uuid' => Str::uuid(),
            'body' => '{"time":1629646555185,"blocks":[{"id":"oPpXIDM_IG","type":"header","data":{"text":"hello world","level":1}}],"version":"2.22.2"}',
        ];
    }
}
