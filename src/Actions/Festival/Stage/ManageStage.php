<?php

namespace BCleverly\Backend\Actions\Festival\Stage;

use BCleverly\Backend\Models\Festival\FestivalDay;
use BCleverly\Backend\Models\Festival\FestivalPerformer;
use BCleverly\Backend\Models\Festival\FestivalStage;
use Lorisleiva\Actions\Concerns\AsAction;

class ManageStage
{
    use AsAction;

    public function handle(FestivalStage $stage): array
    {
        return [
            'stage' => $stage,
        ];
    }

    public function asController(FestivalStage $stage): array
    {
        return $this->handle($stage);
    }

    public function htmlResponse($data)
    {
        return response()->view('backend::festival.day.index', $data);
    }
}
