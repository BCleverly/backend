<?php

namespace BCleverly\Backend\Actions\Festival;

use BCleverly\Backend\Models\Festival\Festival;
use BCleverly\Backend\Models\Page;
use Illuminate\Contracts\Filesystem\Factory as Filesystem;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateFestival
{
    use AsAction;

    public function handle(): Festival
    {
        $festival = Festival::where('name', '')->first();
        if ($festival === null) {
            $festival = Festival::create();
        }

        return $festival;
    }

    public function htmlResponse(Festival $festival)
    {
        return response()->redirectToRoute('dashboard.festival.edit', $festival);
    }
}