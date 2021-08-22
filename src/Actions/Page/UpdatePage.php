<?php

namespace BCleverly\Backend\Actions\Page;

use BCleverly\Backend\Events\Page\PageUpdated;
use BCleverly\Backend\Http\Resources\Page\BlogPostResource;
use BCleverly\Backend\Http\Resources\Page\PageResource;
use BCleverly\Backend\Models\Page;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;
use JetBrains\PhpStorm\Pure;
use Lorisleiva\Actions\Action;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdatePage
{
    use AsAction;

    public function rules(ActionRequest $request): array
    {
        return [
            'id'               => ['required', 'integer'],
            'parent_id'        => ['nullable', 'integer', Rule::exists('pages', 'id')],
            'name'             => ['required', 'string'],
            'slug'             => [
                'required',
                'string',
                Rule::unique(config('backend.database.table_names.page'))->ignore($request->id, 'id'),
            ],
            'excerpt'          => ['nullable', 'string'],
            'body'             => ['nullable'],
            'publish_at'       => [
                'nullable',
                'date',
            ],
            'un_publish_at'    => [
                'nullable',
                'date',
                'after_or_equal:publish_at',
            ],
            'categories'       => [
                'nullable',
                Rule::exists('tags', 'name->'.app()->getLocale())->where('type', 'categories'),
            ],
            'tags'             => [
                'nullable',
                Rule::exists('tags', 'name->'.app()->getLocale())->where('type', 'tags'),
            ],
            'heroImage'        => [
                'nullable',
                'file',
            ],
            'meta.title'       => [
                'nullable',
                'string',
            ],
            'meta.description' => [
                'nullable',
                'string',
            ],
            'meta.image'       => [
                'nullable',
                'file',
            ],
            'saveAction'       => [
                'required',
                'string',
            ],
        ];
    }

    public function handle(ActionRequest $request, Page $page): array
    {
        $data = $request->validated();

        $page->metaTag()->update($data['meta']);

        if ($request->has('heroImage')) {
            $page
                ->addMediaFromRequest('heroImage')
                ->withResponsiveImages()
                ->toMediaCollection('heroImage');
        }

        if ($request->has('meta.hero')) {
            $page
                ->metaTag
                ->addMediaFromRequest('meta.hero')
                ->toMediaCollection('hero');
        }

        $page
            ->syncTagsWithType(
                $data['categories'] ?? [],
                'categories'
            )->syncTagsWithType(
                $data['tags'] ?? [],
                'tags'
            )->update($data);

        event(new PageUpdated($page));

        return [
            'data' => $data,
            'page' => $page,
        ];
    }

    public function asController(ActionRequest $request, Page $page)
    {
        return $this->handle($request, $page);
    }

    public function htmlResponse($data): RedirectResponse
    {
        if ($data['data']['saveAction'] === 'saveClose') {
            return redirect()->route('dashboard.page.index');
        }

        return redirect()->route('dashboard.page.edit', $data['page']);
    }

    public function jsonResponse(array $data): PageResource
    {
        return new PageResource($data['page']);
    }
}