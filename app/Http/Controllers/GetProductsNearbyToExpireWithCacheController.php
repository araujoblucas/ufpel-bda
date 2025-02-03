<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Benchmark;

class GetProductsNearbyToExpireWithCacheController extends Controller
{
    public function __construct(
        protected ProductService $service
    ) {
    }

    public function __invoke()
    {
        $result = Benchmark::measure(function () {
           cache()->remember("search_product_to_expire_with_word_Pada", 999, function () {
                return $this->service->getProductNearbyToExpire("Pada");
           });
        });

        return response()->json([
            round($result, 2)
        ]);
    }
}
