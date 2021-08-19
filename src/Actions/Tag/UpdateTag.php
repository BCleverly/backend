<?php

namespace BCleverly\Backend\Actions\Tag;

use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\Tags\Tag;

class UpdateTag
{
    use AsAction;

    public function rules(ActionRequest $request): array
    {
        return [
            'name' => [
                'required',
                Rule::unique('tags')
            ],
        ];
    }

    public function handle(ActionRequest $request, Tag $tag) : Tag
    {
        $tag->update($request->validated());
        return $tag;
    }

    public function htmlResponse(Tag $tag) : RedirectResponse
    {
        return redirect()->route('dashboard.tag.type.index', $tag->type);
    }

    public function jsonResponse()
    {
    }
}