<?php

namespace BCleverly\Backend\Actions\Tag;

use Illuminate\Database\Eloquent\Collection;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\Tags\Tag;

class ListTagByType
{
    use AsAction;

    public function handle(string $type)
    {
        return Tag::where('type', $type)->paginate();
    }

    public function asController(string $type)
    {
        return $this->handle($type);
    }

    public function htmlResponse($tags)
    {
        return response()->view('backend::tag.type.index', [
            'tags' => $tags,
        ]);
    }
}
