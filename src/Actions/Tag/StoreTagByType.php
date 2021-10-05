<?php

namespace BCleverly\Backend\Actions\Tag;

use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\Tags\Tag;

class StoreTagByType
{
    use AsAction;

    public function rules(): array
    {
        return [
            'name' => [
                'required',
            ],
        ];
    }

    public function handle(ActionRequest $request)
    {
        return Tag::create(['name' => $request->validated()]);
    }

    public function asController(ActionRequest $request)
    {
        return $this->handle($request);
    }

    public function htmlResponse(): \Illuminate\Http\RedirectResponse
    {
        return redirect()->route('backend::tag.type.index');
    }

    public function jsonResponse(Tag $tag): Tag
    {
        return $tag;
    }
}
