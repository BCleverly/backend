<?php

namespace BCleverly\Backend\Events\Page;

use BCleverly\Backend\Models\Page;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PageCreated
{
    use Dispatchable, SerializesModels;

    public function __construct(public Page $page)
    {
    }
}
