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
            'body'       => [
                'required',
            ],
            'heroImage'        => [
                'nullable',
                'file',
            ],
            'meta.title'       => [
                'nullable',
                'string',
            ],
            'meta.description' => [
                'nullable',
                'string',
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
        $performer->metaTag()->update($request->get('meta'));

        if ($request->has('heroImage')) {
            $performer
                ->addMediaFromRequest('heroImage')
                ->withResponsiveImages()
                ->toMediaCollection('heroImage');
        }

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
