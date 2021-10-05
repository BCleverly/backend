<?php

namespace BCleverly\Backend\Actions\Festival\Performer;

use BCleverly\Backend\Models\Festival\FestivalDay;
use BCleverly\Backend\Models\Festival\FestivalPerformer;
use Illuminate\Contracts\Filesystem\Factory as Filesystem;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdatePerformer
{
    use AsAction;

    public function rules(): array
    {
        return [
            'name'       => [
                'required',
            ],
            'saveAction' => [
                'required',
                'string',
            ],
        ];
    }

    public function handle(ActionRequest $request, FestivalPerformer $performer): array
    {
        $performer->update($request->validated());
        return [
            'performer' => $performer,
            'saveAction' => $request->get('saveAction')
        ];
    }

    public function htmlResponse($data)
    {
        if ($data['saveAction'] === 'saveClose') {
            return response()->redirectToRoute('dashboard.festival.dashboard');
        }
        return back();
    }
}
