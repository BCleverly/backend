<?php

namespace BCleverly\Backend\Actions;

use BCleverly\Backend\Search\Dashboard;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
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
        return ['results' => Dashboard::search(
            $request->get('query')
        )->paginate()];
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
