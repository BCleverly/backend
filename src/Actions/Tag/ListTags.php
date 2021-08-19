<?php

namespace BCleverly\Backend\Actions\Tag;

use Illuminate\Database\Eloquent\Collection;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\Tags\Tag;

class ListTags
{
    use AsAction;

    public function handle(): Collection
    {
        return Tag::select('type')->distinct()->get();
    }

    public function htmlResponse(Collection $tags): \Illuminate\Http\Response
    {
        return response()->view('backend::tag.index', compact('tags'));
    }

    public function jsonResponse($tags): \Illuminate\Http\Response
    {
        return $tags;
    }
}
