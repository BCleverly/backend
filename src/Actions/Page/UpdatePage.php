<?php

namespace BCleverly\Backend\Actions\Page;

use BCleverly\Backend\Http\Resources\Page\BlogPostResource;
use BCleverly\Backend\Models\Page;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdatePage
{
    use AsAction;

    public function rules(ActionRequest $request): array
    {
        return [
            'id'               => ['required', 'integer'],
            'name'             => ['required', 'string'],
            'slug'             => [
                'required',
                'string',
                Rule::unique(config('backend.database.table_names.page'))->ignore($request->id, 'id'),
            ],
            'excerpt'          => ['required', 'string'],
            'body'             => ['nullable'],
            'publish_at'       => [
                'nullable',
                'date',
            ],
            'un_publish_at'       => [
                'nullable',
                'date',
                'after_or_equal:publish_at'
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
        ];
    }

    public function handle(ActionRequest $request, Page $page): bool
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

        return $page->syncTagsWithType(
            $data['categories'] ?? [],
            'categories'
        )->syncTagsWithType(
            $data['tags'] ?? [],
            'tags')
         ->update($data);
    }

    public function asController(ActionRequest $request, Page $page)
    {
        return $this->handle($request, $page);
    }

    public function htmlResponse(): RedirectResponse
    {
        return redirect()->route('dashboard.page.index');
    }

    public function jsonResponse(Page $page): BlogPostResource
    {
        return new BlogPostResource($page);
    }
}