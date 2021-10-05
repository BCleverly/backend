<?php

namespace BCleverly\Backend\Observers;

use BCleverly\Backend\Models\Festival\FestivalPerformer;
use Illuminate\Support\Str;

class FestivalPerformerObserver
{
    public function creating(FestivalPerformer $performer): void
    {
        $performer->uuid = Str::uuid();
    }

    public function created(FestivalPerformer $performer): void
    {
        $performer->metaTag()->create();
    }
}
