<?php

namespace BCleverly\Backend\Actions\User;

use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreUser
{
    use AsAction;

    protected $user;

    public function __construct() 
    {
        $user = config('backend.user_class');
        $this->user = new $user;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string'
            ],
            'email' => [
                'required',
                'email', 
                Rule::unique('users', 'email')
            ],
            'password' => [
                'required',
                'confirmed',
                Password::default()
            ]
        ];
    }

    public function handle(ActionRequest $request)
    {
        return $this->user->create($request->validated());
    }

    public function htmlResponse()
    {
        return response()->redirectToRoute('dashboard.user.index');
    }

    public function jsonResponse($data)
    {
        return response()->json($data);
    }
}
