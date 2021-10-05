<?php

namespace BCleverly\Backend\Actions\Tag;

use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\Tags\Tag;

class EditTag
{
    use AsAction;

    public function asController(Tag $tag)
    {
        return [
            'tag' => $tag,
        ];
    }

    public function htmlResponse($data): \Illuminate\Http\Response
    {
        return response()->view('backend::tag.edit', $data);
    }
}
