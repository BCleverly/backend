<?php

namespace BCleverly\Backend\Actions\Page;

use BCleverly\Backend\Http\Resources\Page\BlogPostsResource;
use BCleverly\Backend\Models\Page;
use Illuminate\Pagination\LengthAwarePaginator;
use Lorisleiva\Actions\Concerns\AsAction;

class ListPages
{
    use AsAction;

    public function handle($type): array
    {
        return [
            'type'  => $type,
            'pages' => Page::type($type)->orderBy('updated_at')->paginate(),
        ];
    }

    public function htmlResponse($data)
    {
        return view('backend::page.index', $data);
    }

    public function jsonResponse($pages): BlogPostsResource
    {
        return new BlogPostsResource($pages);
    }
}
