<?php

namespace BCleverly\Backend\Actions\Festival\Performer;

use BCleverly\Backend\Models\Festival\Performer;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class CreatePerformer
{
    use AsAction;

    public function handle(ActionRequest $request): Performer
    {
        $festival = Performer::where('name', '')->first();
        if ($festival === null) {
            $festival = Performer::create();
        }

        return $festival;
    }

    public function htmlResponse($data)
    {
        return response()->view('backend::festival.performer.index', $data);
    }
}