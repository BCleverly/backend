<?php

namespace BCleverly\Backend\Actions\Tag;

use BCleverly\Backend\Models\Tag;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateTag
{
    use AsAction;

    public function handle(): array
    {
        return [
            'tagTypes' => Tag::select('type')->distinct()->get()->transform(function($item) {
                return [
                    'value' => $item->type,
                    'text' => $item->type
                ];
            })->all()
        ];
    }

    public function htmlResponse($data)
    {
        return response()->view('backend::tag.create', $data);
    }

    public function jsonResponse($data)
    {
        return $data;
    }
}
