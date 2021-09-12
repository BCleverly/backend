<?php

namespace BCleverly\Backend\Observers;

use BCleverly\Backend\Models\Festival\Festival;
use BCleverly\Backend\Models\MetaTag;
use Illuminate\Support\Str;

class FestivalObserver
{
    public function creating(Festival $festival): void
    {
        $festival->uuid = Str::uuid();
    }

    public function created(Festival $festival): void
    {
        $festival->metaTag()->create();
    }
}