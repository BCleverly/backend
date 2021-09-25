<?php

namespace BCleverly\Backend\Actions\Festival;

use BCleverly\Backend\Models\Festival\FestivalDay;
use BCleverly\Backend\Models\Festival\FestivalPerformer;
use BCleverly\Backend\Models\Festival\FestivalStage;
use Lorisleiva\Actions\Concerns\AsAction;

class ManageFestival
{
    use AsAction;

    public function handle(): array
    {
        return [
            'days' => FestivalDay::orderBy('updated_at')->limit(5)->get(),
            'stages' => FestivalStage::orderBy('updated_at')->limit(5)->get(),
            'performers' => FestivalPerformer::orderBy('updated_at')->limit(5)->get(),
        ];
    }

    public function htmlResponse($data)
    {
        return response()->view('backend::festival.index', $data);
    }
}