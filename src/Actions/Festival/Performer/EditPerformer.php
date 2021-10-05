<?php

namespace BCleverly\Backend\Actions\Festival\Performer;

use BCleverly\Backend\Models\Festival\FestivalPerformer;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class EditPerformer
{
    use AsAction;

    public function handle(FestivalPerformer $performer): array
    {
        return [
            'performer' => $performer
        ];
    }

    public function asController(FestivalPerformer $performer)
    {
        return $this->handle($performer);
    }

    public function htmlResponse($data)
    {
        return response()->view('backend::festival.performer.edit', $data);
    }
}
