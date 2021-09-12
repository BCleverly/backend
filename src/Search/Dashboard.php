<?php

namespace BCleverly\Backend\Search;

use Algolia\ScoutExtended\Searchable\Aggregator;
use BCleverly\Backend\Models\Festival\{Festival, Performer};
use BCleverly\Backend\Models\Page;
use Laravel\Scout\Searchable;

class Dashboard extends Aggregator {

    protected $models = [
        Festival::class,
        Page::class,
        Performer::class
    ];

    public function shouldBeSearchable()
    {
        // Check if the class uses the Searchable trait before calling shouldBeSearchable
        if (array_key_exists(Searchable::class, class_uses($this->model))) {
            return $this->model->shouldBeSearchable();
        }
    }

}