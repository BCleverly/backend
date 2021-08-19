<?php

namespace BCleverly\Backend\Observers;

use BCleverly\Backend\Models\MetaTag;
use BCleverly\Backend\Models\Page;
use Illuminate\Support\Str;

class PageObserver
{
    public function creating(Page $page): void
    {
        $page->uuid = Str::uuid();
    }

    public function created(Page $page): void
    {
        MetaTag::create([
            'page_id' => $page->id,
        ]);
    }
}