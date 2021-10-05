<?php

namespace BCleverly\Backend\Actions\Festival\Performer;

use BCleverly\Backend\Models\Festival\FestivalPerformer;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class ListPerformers
{
    use AsAction;

    public function handle(ActionRequest $request): array
    {
        return [
            'performers' => FestivalPerformer::paginate(),
        ];
    }

    public function htmlResponse($data)
    {
        return response()->view('backend::festival.performer.index', $data);
    }

    public function jsonResponse($data)
    {
        return response()->json($data['performers']);
    }
}
