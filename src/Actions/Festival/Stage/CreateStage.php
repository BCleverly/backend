<?php

namespace BCleverly\Backend\Actions\Festival\Stage;

use BCleverly\Backend\Models\Festival\FestivalDay;
use BCleverly\Backend\Models\Festival\FestivalPerformer;
use BCleverly\Backend\Models\Festival\FestivalStage;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateStage
{
    use AsAction;

    public function handle(): array
    {
        return [
            'stage' => FestivalStage::where('name', '')->firstOrCreate([
                'name' => ''
            ])
        ];
    }

    public function asController(): array
    {
        return $this->handle();
    }

    public function htmlResponse($data)
    {
        return response()->redirectToRoute('dashboard.festival.stage.edit', $data);
    }
}
