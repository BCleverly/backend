<?php

namespace BCleverly\Backend\Actions\Festival\Day;

use BCleverly\Backend\Models\Festival\FestivalDay;
use BCleverly\Backend\Models\Festival\FestivalPerformer;
use BCleverly\Backend\Models\Festival\FestivalStage;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreDay
{
    use AsAction;

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
            ],
        ];
    }

    public function handle(ActionRequest $request): array
    {
        return [
            'day' => FestivalDay::create($request->validated()),
        ];
    }

    public function asController(ActionRequest $request): array
    {
        return $this->handle($request);
    }

    public function htmlResponse()
    {
        return response()->redirectToRoute('dashboard.festival.dashboard');
    }
}