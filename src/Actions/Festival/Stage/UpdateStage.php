<?php

namespace BCleverly\Backend\Actions\Festival\Stage;

use BCleverly\Backend\Models\Festival\FestivalDay;
use BCleverly\Backend\Models\Festival\FestivalPerformer;
use BCleverly\Backend\Models\Festival\FestivalStage;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateStage
{
    use AsAction;

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
            ],
            'saveAction' => [
                'required',
                'string',
            ],
        ];
    }

    public function handle(ActionRequest $request, FestivalStage $stage): array
    {
        $stage->update($request->validated());
        return [
            'stage' => $stage,
            'saveAction' => $request->get('saveAction')
        ];
    }

    public function asController(ActionRequest $request, FestivalStage $stage): array
    {
        return $this->handle($request, $stage);
    }

    public function htmlResponse($data)
    {
        if ($data['saveAction'] === 'saveClose') {
            return response()->redirectToRoute('dashboard.festival.dashboard');
        }
        return back();
    }
}
