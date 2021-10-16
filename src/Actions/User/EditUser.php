<?php

namespace BCleverly\Backend\Actions\User;

use Lorisleiva\Actions\Concerns\AsAction;

class EditUser
{
    use AsAction;

    public function handle($user): array
    {
        $userClass = config('backend.user_class');
        $user = (new $userClass)->findOrFail($user);
        return [
            'user' => $user
        ];
    }

    public function htmlResponse($data)
    {
        return view('backend::user.edit', $data);
    }
}
