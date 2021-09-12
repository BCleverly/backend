<?php

namespace BCleverly\Backend\Actions\Page;

use BCleverly\Backend\Models\Page;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\Tags\Tag;

class CreatePage
{
    use AsAction;

    public function handle(): Page
    {
        $page = Page::where('name', '')->first();
        if ($page === null) {
            $page = new Page;
            $page
                ->author()
                ->associate(auth()->user())
                ->save();
        }

        return $page;
    }

    public function htmlResponse(Page $page)
    {
        return response()->redirectToRoute('dashboard.page.edit', $page);
    }
}