<?php

namespace BCleverly\Backend\Observers;

use BCleverly\Backend\Models\Festival\Performer;
use Illuminate\Support\Str;

class PerformerObserver
{
    public function creating(Performer $performer): void
    {
        $performer->uuid = Str::uuid();
    }

    public function created(Performer $performer): void
    {
        $performer->metaTag()->create();
    }
}