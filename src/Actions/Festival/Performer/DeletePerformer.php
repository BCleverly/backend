<?php

namespace BCleverly\Backend\Actions\Festival\Performer;

use BCleverly\Backend\Models\Festival\Festival;
use BCleverly\Backend\Models\Festival\Performer;
use Illuminate\Contracts\Filesystem\Factory as Filesystem;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class DeletePerformer
{
    use AsAction;

    public function handle(Performer $performer): bool
    {
        return $performer->delete();
    }

    public function htmlResponse()
    {
        return response()->view('festival.performer.index');
    }
}