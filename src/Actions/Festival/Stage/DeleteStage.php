<?php

namespace BCleverly\Backend\Actions\Festival\Stage;

use BCleverly\Backend\Models\Festival\FestivalDay;
use BCleverly\Backend\Models\Festival\FestivalPerformer;
use BCleverly\Backend\Models\Festival\FestivalStage;
use Illuminate\Contracts\Filesystem\Factory as Filesystem;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteStage
{
    use AsAction;

    public function handle(FestivalStage $stage): bool
    {
        return $stage->delete();
    }

    public function htmlResponse()
    {
        return response()->redirectToRoute('festival.performer.index');
    }
}
