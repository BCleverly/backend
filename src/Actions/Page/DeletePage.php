<?php

namespace BCleverly\Backend\Actions\Page;

use BCleverly\Backend\Models\Page;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\Tags\Tag;

class DeletePage
{
    use AsAction;

    public function handle(Page $page)
    {
        return $page->delete();
    }

    public function htmlResponse()
    {
        return redirect()->route('dashboard.page.index');
    }
}