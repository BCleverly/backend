<?php

namespace BCleverly\Backend\Actions\Festival;

use BCleverly\Backend\Models\Festival\Festival;
use Illuminate\Contracts\Filesystem\Factory as Filesystem;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreFestival
{
    use AsAction;

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
            ],
            'body' => [
                'required',
                'string',
            ],
            'uuid' => [
                'required',
                'string',
            ],
        ];
    }

    public function handle(ActionRequest $request): array
    {
        return Festival::create($request->validated());
    }

    public function htmlResponse()
    {
        return response()->redirectToRoute('dashboard.festival.index');
    }
}