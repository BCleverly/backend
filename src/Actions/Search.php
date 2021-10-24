<?php

namespace BCleverly\Backend\Actions;

use BCleverly\Backend\Search\Dashboard;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class Search
{
    use AsAction;

    public function __construct()
    {
    }

    public function handle(ActionRequest $request)
    {
        return [
            'results' => Dashboard::search(
                $request->get('search')
            )->paginate(),
        ];
    }

    public function htmlResponse($data)
    {
        return view('backend::search.index', $data);
    }

    public function jsonResponse($data)
    {
        return response()->json($data);
    }
}
