<?php

namespace BCleverly\Backend\Actions\Store\Product;

use BCleverly\Backend\Models\Product;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateProduct
{
    use AsAction;

    public function rules(): array
    {
        return [];
    }

    public function handle(ActionRequest $request, Product $product): Product
    {
        $product->update($request->validated());

        return $product;
    }

    public function asController(ActionRequest $request, Product $product): Product
    {
        return $this->handle($request, $product);
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
