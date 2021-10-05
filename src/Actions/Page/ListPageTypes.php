<?php

namespace BCleverly\Backend\Actions\Page;

use BCleverly\Backend\Http\Resources\Page\BlogPostsResource;
use BCleverly\Backend\Models\Page;
use Illuminate\Pagination\LengthAwarePaginator;
use Lorisleiva\Actions\Concerns\AsAction;

class ListPageTypes
{
    use AsAction;

    public function handle(): array
    {
        return [
            'types' => Page::select('type')->distinct()->get(),
        ];
    }

    public function htmlResponse($data)
    {
        return view('backend::page.types', $data);
    }

    public function jsonResponse($data): \Illuminate\Http\JsonResponse
    {
        return response()->json($data);
    }
}
