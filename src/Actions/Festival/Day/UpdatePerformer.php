<?php

namespace BCleverly\Backend\Actions\Festival\Day;

use BCleverly\Backend\Models\Festival\FestivalDay;
use BCleverly\Backend\Models\Festival\FestivalPerformer;
use BCleverly\Backend\Models\Festival\FestivalStage;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdatePerformer
{
    use AsAction;

    public function rules(): array
    {
        return [

            'body' => [
                'required'
            ],
            'headliner' => [
                'nullable',
            ],
            'time'      => [
                'required',
            ],
        ];
    }

    public function handle(ActionRequest $request, FestivalDay $day, $performer): FestivalDay
    {
        dd($request->validated());
        $performer->update($request->except(['headline', 'time']));
        $day->performers()->sync([
            $performer => [
                'headline' => $request->validated()['headline'] ?? false,
                'time'     => $request->validated()['time'],
            ],
        ], false);

        return $day;
    }

    public function asController(ActionRequest $request, FestivalDay $day,$performer ): FestivalDay
    {
        return $this->handle($request, $day, $performer);
    }

    public function htmlResponse()
    {
        return back();
    }
}
