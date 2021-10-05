<?php

namespace BCleverly\Backend\Observers;

use BCleverly\Backend\Models\Festival\FestivalDay;
use Illuminate\Support\Str;

class FestivalDayObserver
{
    public function creating(FestivalDay $festivalDay): void
    {
        $festivalDay->uuid = Str::uuid();
    }

    public function created(FestivalDay $festivalDay): void
    {
        $festivalDay->metaTag()->create();
    }
}
