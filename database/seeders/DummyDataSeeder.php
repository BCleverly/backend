<?php

namespace BCleverly\Backend\Database\Seeders;

use BCleverly\Backend\Models\Page;
use Illuminate\Database\Seeder;

class DummyDataSeeder extends Seeder
{
    public function run()
    {
        $pageTypes = ['page', 'blog'];
        Page::factory(10)->create()->each(function ($model, $index) use ($pageTypes) {
            $model->update(['type' => $pageTypes[random_int(0, count($pageTypes) - 1)]]);
            $model->attachTags(['Category '.$index], 'categories');
            $model->attachTags(['Tag '.$index], 'tags');
        });
    }
}
