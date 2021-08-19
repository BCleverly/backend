<?php

namespace BCleverly\Backend\Actions\Tag;

use BCleverly\Backend\Models\Tag;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteTag
{
    use AsAction;

    public function handle(ActionRequest $request, Tag $tag)
    {
        return $tag->delete();
    }

    public function htmlResponse($data): \Illuminate\Http\RedirectResponse
    {
        return redirect()->back();
    }

    public function jsonResponse(): array
    {
        return ['message' => 'ok'];
    }
}
