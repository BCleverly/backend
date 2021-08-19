<?php

namespace BCleverly\Backend\Actions;

use BCleverly\Backend\Models\Page;
use Lorisleiva\Actions\Concerns\AsAction;

class ShowDashboard
{
    use AsAction;

    public function handle()
    {
        return [
            'pages' => Page::limit(5)->orderBy('updated_at')->get()
        ];
    }

    public function htmlResponse($data)
    {
        return view('backend::dashboard', $data);
    }
}
