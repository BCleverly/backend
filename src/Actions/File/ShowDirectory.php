<?php

namespace BCleverly\Backend\Actions\File;

use Illuminate\Contracts\Filesystem\Factory as Filesystem;
use Lorisleiva\Actions\Concerns\AsAction;

class ShowDirectory
{
    use AsAction;

    private \Illuminate\Contracts\Filesystem\Filesystem $storage;

    public function __construct(Filesystem $storage)
    {
        $this->storage = $storage->disk('public-uploads');
    }

    public function handle(string $path = ''): array
    {
        if ($this->storage->exists($path) === false && $path !== '') {
            abort(404);
        }

        return [
            'path' => $path,
            'files' => $this->storage->files($path),
            'directories' => $this->storage->directories($path)
        ];
    }

    public function htmlResponse($data)
    {
        return view('backend::file.index', $data);
    }
}