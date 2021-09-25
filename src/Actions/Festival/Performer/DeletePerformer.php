<?php

namespace BCleverly\Backend\Actions\Festival\Performer;

use BCleverly\Backend\Models\Festival\FestivalDay;
use BCleverly\Backend\Models\Festival\FestivalPerformer;
use Illuminate\Contracts\Filesystem\Factory as Filesystem;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class DeletePerformer
{
    use AsAction;

    public function handle(FestivalPerformer $performer): bool
    {
        return $performer->delete();
    }

    public function htmlResponse()
    {
        return response()->view('festival.performer.index');
    }
}