<?php

namespace BCleverly\Backend\Actions\Store;

use Lorisleiva\Actions\Concerns\AsAction;

class StoreDashboard
{
    use AsAction;

    public function handle()
    {
        return view('dashboard.store.index');
    }
}
