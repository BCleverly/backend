<?php

namespace BCleverly\Backend\Actions\Festival\Performer;

use BCleverly\Backend\Models\Festival\FestivalPerformer;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class CreatePerformer
{
    use AsAction;

    public function handle(ActionRequest $request): FestivalPerformer
    {
        $festival = FestivalPerformer::where('name', '')->first();
        if ($festival === null) {
            $festival = FestivalPerformer::create();
        }

        return $festival;
    }

    public function htmlResponse($data)
    {
        return response()->redirectToRoute('dashboard.festival.performer.edit', $data);
    }
}
