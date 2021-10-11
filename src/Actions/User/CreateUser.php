<?php

namespace BCleverly\Backend\Actions\User;

use Lorisleiva\Actions\Concerns\AsAction;

class CreateUser
{
    use AsAction;

    public function handle(): void
    {
    }

    public function htmlResponse()
    {
        return view('backend::user.create');
    }
}
