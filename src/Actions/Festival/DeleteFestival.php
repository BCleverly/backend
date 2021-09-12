<?php

namespace BCleverly\Backend\Actions\Festival;

use BCleverly\Backend\Models\Festival\Festival;
use Illuminate\Contracts\Filesystem\Factory as Filesystem;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteFestival
{
    use AsAction;

    public function handle(Festival $festival): bool
    {
        return $festival->delete();
    }

    public function htmlResponse()
    {
        return response()->view('festival.index');
    }
}