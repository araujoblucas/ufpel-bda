<?php

namespace App\Services;

use App\Models\Product;
use Database\Factories\ProductFactory;
use Illuminate\Support\Arr;

class ProductService
{
    public function getFirst(): ?array
    {
        return Product::first()?->toArray();
    }

    public function getListAvailable(): ?array
    {
        return Product::where('is_active', true)
            ->where('quantity_available', '>', 0)
            ->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(other_information, '$.due_date')) >= ?", [now()->toDateString()])
            ->limit(1000)->get()?->toArray();

    }

    public function edit(int $id)
    {
        return Product::where('id', $id)
            ->update([
                'name' =>  Arr::random(config('products_names')),
            ]);
    }

    public function create()
    {
        return ProductFactory::new()->create();
    }

    public function delete(int $id)
    {
        return Product::where('id', $id)->delete();
    }

}
