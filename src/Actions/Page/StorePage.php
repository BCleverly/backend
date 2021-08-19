<?php

namespace BCleverly\Backend\Actions\Page;

use BCleverly\Backend\Http\Resources\Page\PageResource;
use BCleverly\Backend\Models\Page;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class StorePage
{
    use AsAction;

    public function rules()
    {
        return [
            'name'        => [
                'required',
                'string',
            ],
            'slug'        => ['required', 'string', 'unique:'.config('backend.database.table_names.page')],
            'description' => [
                'required',
                'string',
            ],
            'body'        => [
                'nullable',
            ],
            'publish_at'  => [
                'nullable',
            ],
            'categories'  => [
                'nullable',
                Rule::exists('tags', 'name->'.app()->getLocale())->where('type', 'categories'),
            ],
            'tags'        => [
                'nullable',
                Rule::exists('tags', 'name->'.app()->getLocale())->where('type', 'tags'),
            ],
        ];
    }

    public function handle(array $data): Page
    {
        $page = new Page;
        $page
            ->author()->associate(auth()->user())
            ->fill($data)->save();
        $page->syncTagsWithType($data['categories'] ?? [], 'categories')
             ->syncTagsWithType($data['tags'] ?? [], 'tags');

        return $page;
    }

    public function asController(ActionRequest $request): Page
    {
        return $this->handle($request->validated());
    }

    public function htmlResponse(Page $page): \Illuminate\Http\RedirectResponse
    {
        return response()->redirectToRoute('dashboard.page.index');
    }

    public function jsonResponse(Page $page): PageResource
    {
        return new PageResource($page);
    }
}