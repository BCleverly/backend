<?php

namespace BCleverly\Backend\Actions\Page;

use BCleverly\Backend\Models\Page;
use Illuminate\View\View;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\Tags\Tag;

class EditPage
{
    use AsAction;

    public function handle(Page $page): array
    {
        return [
            'page' => $page,
            'pages' => Page::all('id','name')->transform(function($item) {
                return [
                    'value' => $item->id,
                    'text' => $item->name
                ];
            })->all(),
            'pageTags' => $page->tags->groupBy('type')->each->transform(fn($item) => $item->name)->toArray(),
            'categories' => Tag::where('type','categories')->get(['name'])->transform(function($item) {
                return [
                    'value' => $item->name,
                    'text' => $item->name
                ];
            })->all(),
            'tags' => Tag::where('type','tags')->get(['name'])->transform(function($item) {
                return [
                    'value' => $item->name,
                    'text' => $item->name
                ];
            })->all(),
        ];
    }

    public function htmlResponse($data): View
    {
        return view('backend::page.edit', $data);
    }
}