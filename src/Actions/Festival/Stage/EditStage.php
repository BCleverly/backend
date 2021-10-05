<?php

namespace BCleverly\Backend\Actions\Festival\Stage;

use BCleverly\Backend\Models\Festival\FestivalDay;
use BCleverly\Backend\Models\Festival\FestivalPerformer;
use BCleverly\Backend\Models\Festival\FestivalStage;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class EditStage
{
    use AsAction;

    public function handle(FestivalStage $stage): array
    {
        return [
            'stage' => $stage
        ];
    }

    public function asController(FestivalStage $stage)
    {
        return $this->handle($stage);
    }

    public function htmlResponse($data)
    {
        return response()->view('backend::festival.stage.edit', $data);
    }
}
