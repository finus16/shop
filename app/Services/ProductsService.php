<?php

namespace App\Services;

use App\Models\Product;

class ProductsService
{
    public function create(array $data): bool
    {
        $product = new Product($data);

        return $product->save();
    }

    public function update(Product &$product, $data): bool
    {
        $product->update($data);

        return $product->save();
    }

    public function delete(Product &$product): ?bool
    {
        return $product->delete();
    }
}
