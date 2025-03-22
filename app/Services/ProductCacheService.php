<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Arr;

class ProductCacheService
{
    public function __construct(private readonly ProductService $productService)
    {
    }

    public function getFirst(): ?array
    {
        return cache()->rememberForever('product_first_1', function () {
            $products = $this->productService->getFirst();
            $products['other_information'] = json_decode($products['other_information']);
            return $products;
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
