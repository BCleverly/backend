<?php

namespace BCleverly\Backend\Actions\Page;

use BCleverly\Backend\Models\Page;
use Illuminate\Http\Request;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\Tags\Tag;

class UploadPageMedia
{
    use AsAction;

    public function rules()
    {
        return [
            'upload' => ['nullable'],
        ];
    }

    public function handle(ActionRequest $request, Page $page): array
    {
        return [
            'url' => $page->addMediaFromRequest('upload')->withResponsiveImages()->toMediaCollection('images')->getUrl(),
        ];
    }

    public function jsonResponse($data)
    {
        return response()->json($data);
    }
}