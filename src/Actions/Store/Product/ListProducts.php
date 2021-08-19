<?php

namespace BCleverly\Backend\Actions\Store\Product;

use BCleverly\Backend\Models\Product;
use Lorisleiva\Actions\Concerns\AsAction;

class ListProducts
{
    use AsAction;

    public function handle(): array
    {
        return [
            'products' => Product::orderBy('updated_at','desc')->paginate(25)
        ];
    }

    public function htmlResponse(): \Illuminate\Http\Response
    {
        return response()->view('dashboard.store.product.index', $this->handle());
    }

    public function jsonResponse(): \Illuminate\Http\Response
    {
        return $this->handle();
    }
}
