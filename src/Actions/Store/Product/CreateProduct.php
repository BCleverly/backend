<?php

namespace BCleverly\Backend\Actions\Store\Product;

use Lorisleiva\Actions\Concerns\AsAction;

class CreateProduct
{
    use AsAction;

    public function handle(): array
    {
        return [];
    }

    public function asController()
    {
        return view('dashboard.store.product.create', $this->handle());
    }
}
