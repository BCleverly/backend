<?php

namespace BCleverly\Backend\Actions\Festival;

use BCleverly\Backend\Models\Festival\Festival;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class UploadFestivalMedia
{
    use AsAction;

    public function rules()
    {
        return [
            'upload' => ['nullable'],
        ];
    }

    public function handle(ActionRequest $request, Festival $festival): array
    {
        return [
            'success' => true,
            'file' => [
                'url' => $festival->addMediaFromRequest('image')->withResponsiveImages()->toMediaCollection('images')->getUrl()
            ],
        ];
    }

    public function jsonResponse($data): \Illuminate\Http\JsonResponse
    {
        return response()->json($data);
    }
}