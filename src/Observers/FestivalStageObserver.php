<?php

namespace BCleverly\Backend\Observers;

use BCleverly\Backend\Models\Festival\FestivalStage;
use Illuminate\Support\Str;

class FestivalStageObserver
{
    public function creating(FestivalStage $festivalStage): void
    {
        $festivalStage->uuid = Str::uuid();
    }

    public function created(Festivalstage $festivalStage): void
    {
        $festivalStage->metaTag()->create();
    }
}