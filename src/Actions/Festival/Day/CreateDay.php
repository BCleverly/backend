<?php

namespace BCleverly\Backend\Actions\Festival\Day;

use BCleverly\Backend\Models\Festival\FestivalDay;
use BCleverly\Backend\Models\Festival\FestivalPerformer;
use BCleverly\Backend\Models\Festival\FestivalStage;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateDay
{
    use AsAction;

    public function handle(): array
    {
        return [];
    }

    public function asController(): array
    {
        return $this->handle();
    }

    public function htmlResponse()
    {
        return response()->view('backend::festival.day.create');
    }
}