<?php

namespace BCleverly\Backend\Actions\Festival\Day;

use BCleverly\Backend\Models\Festival\FestivalDay;
use BCleverly\Backend\Models\Festival\FestivalPerformer;
use BCleverly\Backend\Models\Festival\FestivalStage;
use Lorisleiva\Actions\Concerns\AsAction;

class ManageDay
{
    use AsAction;

    public function handle(FestivalDay $day): array
    {
        $day->load(['performers', 'performers.metaTag']);

        // TODO This needs improving...
        $day->performers = $day->performers->groupBy('pivot.stage')->sortByDesc('pivot.time');

        return [
            'performers' => FestivalPerformer::all()->transform(function ($item) {
                return [
                    'value' => $item->id,
                    'text' => $item->name,
                ];
            })->all(),
            'day' => $day,
            'stages' => $day->performers->keys()->transform(function ($item) {
                return [
                    'value' => $item,
                    'text' => $item,
                ];
            })->all()
        ];
    }

    public function asController(FestivalDay $day): array
    {
        return $this->handle($day);
    }

    public function htmlResponse($data)
    {
        return response()->view('backend::festival.day.index', $data);
    }
}
