<?php

namespace BCleverly\Backend\Actions\Festival\Day;

use BCleverly\Backend\Models\Festival\FestivalDay;
use BCleverly\Backend\Models\Festival\FestivalPerformer;
use BCleverly\Backend\Models\Festival\FestivalStage;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class AddPerformer
{
    use AsAction;

    public function rules(): array
    {
        return [
            'performer' => [
                'required',
            ],
            'stage' => [
                'required',
            ],
            'headliner' => [
                'nullable',
            ],
            'time' => [
                'required',
            ],
        ];
    }

    public function handle(ActionRequest $request, FestivalDay $day): FestivalDay
    {
        $day->performers()->attach($request->validated()['performer'], [
            'headline' => $request->validated()['headline'] ?? false,
            'time'     => $request->validated()['time'],
            'stage'    => $request->validated()['stage']
        ]);

        return $day;
    }

    public function asController(ActionRequest $request, FestivalDay $day): FestivalDay
    {
        return $this->handle($request, $day);
    }

    public function htmlResponse()
    {
        return back();
    }
}
