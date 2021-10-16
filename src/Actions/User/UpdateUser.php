<?php

namespace BCleverly\Backend\Actions\User;


use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;
use Illuminate\Validation\Rules\Password;

class UpdateUser
{
    use AsAction;

    public function __construct()
    {
        $userClass = config('backend.user_class');
        $this->user = new $userClass;
    }

    public function rules(ActionRequest $request): array
    {
        return [
            'name' => [
                'required',
                'string',
            ],
            'email' => [
                'email',
                'required',
                Rule::unique(config('backend.database.table_names.user'), 'email')->ignore($request->id)
            ],
            'password' => [
                'nullable',
                Password::defaults(),
            ],
            'formAction' => [
                'required',
                'string'
            ]
        ];
    }

    public function handle(ActionRequest $request, $user)
    {
        $this->user = $this->user->findOrFail($user);
        $newData = [
            'name' => $request->validated()['name'],
            'email' => $request->validated()['email'],
        ];
        if ($request->password !== '') {
            $newData['password'] = Hash::make($request->password);
        } 

        return $this->user->update($newData);        
    }

    public function htmlResponse($data)
    {
        return back();
    }
}
