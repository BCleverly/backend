<?php

namespace BCleverly\Backend\Actions\User;

use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class ListUsers
{
    use AsAction;

    public function __construct()
    {
    }

    public function handle(ActionRequest $request)
    {
        $user = config('backend.user_class');
        return [
            'users' => (new $user)->paginate()
        ];
    }

    public function htmlResponse($data)
    {
        return view('backend::user.index', $data);
    }

    public function jsonResponse($data)
    {
        return response()->json($data);
    }
}
