<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class ProductService
{

    public function getProductNearbyToExpire($term = '')
    {
        $result = DB::select("SELECT id, JSON_UNQUOTE(JSON_EXTRACT(product, '$.nome')) AS nome,
                                            JSON_UNQUOTE(JSON_EXTRACT(product, '$.validade.date')) AS validade
                                            FROM products
                                            WHERE JSON_UNQUOTE(JSON_EXTRACT(product, '$.validade.date'))
                                            BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 30 DAY)
                                            and JSON_UNQUOTE(JSON_EXTRACT(product, '$.marca')) like '%$term%'
                                            ORDER BY JSON_UNQUOTE(JSON_EXTRACT(product, '$.validate.date')) DESC,
                                                     JSON_UNQUOTE(JSON_EXTRACT(product, '$.data_fabricacao')) DESC
                                            LIMIT 20
                                            ");


        return $result->toArray ?? [];
    }
}
