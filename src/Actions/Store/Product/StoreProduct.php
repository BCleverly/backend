<?php

namespace BCleverly\Backend\Actions\Store\Product;

use BCleverly\Backend\Models\Product;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreProduct
{
    use AsAction;

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'min:2',
            ],
            'sku' => [
                'required',
                'string',
                'min:2',
            ],
            'description' => [
                'required',
                'string',
                'min:2',
            ],
            'body' => [
                'required',
                'string',
                'min:2',
            ],
            'price' => [
                'required',
                'integer',
            ],
            'weight' => [
                'required',
                'integer',
            ],
        ];
    }

    public function handle(ActionRequest $request): Product
    {
        return Product::create($request->validated());
    }

    public function asController(ActionRequest $request): Product
    {
        return $this->handle($request);
    }

    public function htmlResponse(): \Illuminate\Http\RedirectResponse
    {
        return redirect()->route('dashboard.store.product.index');
    }

    public function jsonResponse(Product $product): Product
    {
        return $product;
    }
}
