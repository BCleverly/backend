<?php

namespace BCleverly\Backend\Actions\File;

use Illuminate\Contracts\Filesystem\Factory as Filesystem;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateDirectory
{
    use AsAction;

    private \Illuminate\Contracts\Filesystem\Filesystem $storage;

    public function __construct(Filesystem $storage)
    {
        $this->storage = $storage->disk('public-uploads');
    }

    public function rules(): array
    {
        return [
            'name' => [
                'nullable',
                'string',
            ],
            'path' => [
                'nullable',
                'string',
            ],
        ];
    }

    public function handle(ActionRequest $request)
    {
        $request->validated();
        if ($this->storage->exists($request->get('path').DIRECTORY_SEPARATOR.$request->get('name'))) {
            return false;
        }

        return $this->storage->makeDirectory($request->get('name'));
    }

    public function htmlResponse()
    {
        return redirect()->back();
    }
}
