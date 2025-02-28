<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Arr;

class ProductCacheService
{
    public function __construct(private ProductService $productService)
    {
    }

    public function getFirst(): ?array
    {
        return cache()->rememberForever('product_first', function () {
            return $this->productService->getFirst();
        });

    }

    public function getListAvailable(): ?array
    {
        return cache()->rememberForever('product_list_available', function () {
            return $this->productService->getListAvailable();
        });
    }

    public function edit(int $id)
    {
        $edited = $this->productService->edit($id);
        cache()->forget('product_first');
        cache()->forget('product_list_available');

        return $edited;

    }

    public function create()
    {
        $created = Product::factory()->create();

        cache()->forget('product_first');
        cache()->forget('product_list_available');

        return $created;
    }

    public function delete(int $id)
    {
        $deleted = $this->productService->delete($id);

        cache()->forget('product_first');
        cache()->forget('product_list_available');

        return $deleted;
    }

}
