<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Benchmark;
use Illuminate\Support\Facades\DB;

class GetProductsNearbyToExpireController extends Controller
{
    public function __construct(
       protected ProductService $service
    ) {
    }

    public function __invoke()
    {
        $result = Benchmark::measure(function () {
            $this->service->getProductNearbyToExpire("Pada");
        });

        return response()->json([
            round($result)
        ]);

    }
}
