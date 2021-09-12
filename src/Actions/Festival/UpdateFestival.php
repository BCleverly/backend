<?php

namespace BCleverly\Backend\Actions\Festival;

use BCleverly\Backend\Models\Festival\Festival;
use Illuminate\Contracts\Filesystem\Factory as Filesystem;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateFestival
{
    use AsAction;

    public function rules(): array
    {
        return [
            'name'             => [
                'required',
                'string',
            ],
            'body'             => [
                'required',
                'string',
            ],
            'publish_at'       => [
                'nullable',
                'date',
            ],
            'meta.title'       => [
                'nullable',
                'string',
            ],
            'meta.description' => [
                'nullable',
                'string',
            ],
            'meta.image'       => [
                'nullable',
                'file',
            ],
            'saveAction'       => [
                'required',
                'string',
            ],

        ];
    }

    public function handle(ActionRequest $request, Festival $festival): array
    {
        $festival->update($request->validated());

        $festival->metaTag()->update($request->validated()['meta']);

        if ($request->has('meta.hero')) {
            $festival
                ->metaTag
                ->addMediaFromRequest('meta.hero')
                ->toMediaCollection('hero');
        }

        return [
            'festival'   => $festival,
            'saveAction' => $request->get('formAction'),
        ];
    }

    public function asController(ActionRequest $request, Festival $festival)
    {
        return $this->handle($request, $festival);
    }

    public function htmlResponse($data)
    {
        if ($data['saveAction'] === 'saveClose') {
            return response()->redirectToRoute('dashboard.festival.index');
        }

        return response()->redirectToRoute('dashboard.festival.edit', [
            $data['festival'],
        ]);
    }
}