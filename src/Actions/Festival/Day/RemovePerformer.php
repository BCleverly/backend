<?php

namespace BCleverly\Backend\Actions\Festival\Day;

use BCleverly\Backend\Models\Festival\FestivalDay;
use BCleverly\Backend\Models\Festival\FestivalPerformer;
use BCleverly\Backend\Models\Festival\FestivalStage;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class RemovePerformer
{
    use AsAction;

    public function handle(FestivalDay $day, $performer): FestivalDay
    {
        $day->performers()->detach($performer);

        return $day;
    }

    public function asController(FestivalDay $day, $performer): FestivalDay
    {
        return $this->handle($day, $performer);
    }

    public function htmlResponse()
    {
        return back();
    }
}
