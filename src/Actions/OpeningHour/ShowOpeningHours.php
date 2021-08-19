<?php

namespace BCleverly\Backend\Actions\OpeningHour;

use Lorisleiva\Actions\Concerns\AsAction;

class ShowOpeningHours
{
    use AsAction;

    public function handle()
    {
        return [

        ];
    }

    public function htmlResponse($data)
    {
        return view('backend::opening-hours', $data);
    }
}
