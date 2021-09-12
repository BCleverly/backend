<?php

namespace BCleverly\Backend\Actions\Festival;

use BCleverly\Backend\Models\Festival\Festival;
use Illuminate\Contracts\Filesystem\Factory as Filesystem;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class ListFestivals
{
    use AsAction;

    public function handle(ActionRequest $request): array
    {
        return [
            'festivals' => Festival::paginate(),
        ];
    }

    public function htmlResponse($data)
    {
        return response()->view('backend::festival.index', $data);
    }
}