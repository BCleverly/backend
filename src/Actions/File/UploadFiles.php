<?php

namespace BCleverly\Backend\Actions\File;

use BCleverly\Backend\Models\File;
use BCleverly\Backend\Models\Page;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class UploadFiles
{
    use AsAction;

    use AsAction;

    public function rules()
    {
        return [
            'upload' => ['nullable'],
        ];
    }

    public function handle(ActionRequest $request): array
    {
        $file = File::create();
        return [
            'success' => true,
            'file' => [
                'url' => $file->addMediaFromRequest('image')->withResponsiveImages()->toMediaCollection('images')->getUrl(),
            ],
        ];
    }

    public function jsonResponse($data): \Illuminate\Http\JsonResponse
    {
        return response()->json($data);
    }
}