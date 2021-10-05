<?php

namespace BCleverly\Backend\Actions\Festival\Day;

use BCleverly\Backend\Models\Festival\FestivalDay;
use BCleverly\Backend\Models\Festival\FestivalPerformer;
use BCleverly\Backend\Models\Festival\FestivalStage;
use Lorisleiva\Actions\Concerns\AsAction;

class ManageDay
{
    use AsAction;

    public function handle(FestivalDay $day): array
    {
        $day->load('stages');
        return [
            'day' => $day
        ];
    }

    public function asController(FestivalDay $day): array
    {
        return $this->handle($day);
    }

    public function htmlResponse($data)
    {
        return response()->view('backend::festival.day.index', $data);
    }
}