<?php

namespace BCleverly\Backend\Actions\Store\Product;

use BCleverly\Backend\Models\Product;
use Lorisleiva\Actions\Concerns\AsAction;

class EditProduct
{
    use AsAction;

    public function asController(Product $product): \Illuminate\Http\Response
    {
        return response()->view('dashboard.store.product.edit', compact('product'));
    }

}
