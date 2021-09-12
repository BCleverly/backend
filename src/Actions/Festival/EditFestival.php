<?php

namespace BCleverly\Backend\Actions\Festival;

use BCleverly\Backend\Models\Festival\Festival;
use Illuminate\Contracts\Filesystem\Factory as Filesystem;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class EditFestival
{
    use AsAction;

    public function handle(Festival $festival): array
    {
        return [
            'festival' => $festival
        ];
    }

    public function htmlResponse($data)
    {
        return response()->view('backend::festival.edit', $data);
    }
}