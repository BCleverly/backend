<?php

namespace BCleverly\Backend\Actions\Festival\Performer;

use BCleverly\Backend\Models\Festival\Performer;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class ListPerformers
{
    use AsAction;

    public function handle(ActionRequest $request): array
    {
        return [
            'performers' => Performer::paginate(),
        ];
    }

    public function htmlResponse($data)
    {
        return response()->view('backend::festival.performer.index', $data);
    }
}