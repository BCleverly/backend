<?php

namespace BCleverly\Backend\Actions\Tag;

use BCleverly\Backend\Models\Tag;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreTag
{
    use AsAction;

    public function rules(): array
    {
        return [
            'name' => [
                'unique:tags',
                'string',
            ],
            'type' => [
                'string',
                'required',
            ],
        ];
    }

    public function handle(ActionRequest $request)
    {
        return Tag::create($request->validated());
    }

    public function htmlResponse(): \Illuminate\Http\RedirectResponse
    {
        return redirect()->route('dashboard.tag.index');
    }
}
