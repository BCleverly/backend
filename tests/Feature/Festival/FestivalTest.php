<?php

namespace BCleverly\Backend\Tests;

use BCleverly\Backend\Models\Festival\Festival;
use BCleverly\Backend\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;

class FestivalTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_can_create_festival()
    {
        $response = $this->post(route('dashboard.festival.store'), [
            'uuid' => Str::uuid(),
            'name' => $this->faker->name,
            'body' => '{"time":1629646555185,"blocks":[{"id":"oPpXIDM_IG","type":"header","data":{"text":"hello world","level":1}}],"version":"2.22.2"}',
        ]);

        $response->assertRedirect(route('dashboard.festival.index'));
    }
}
