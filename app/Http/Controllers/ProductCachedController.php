<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\ProductCacheService;

class ProductCachedController extends Controller
{

    public function __construct(
        protected ProductCacheService $productService
    ) {
    }

    public function show()
    {
        $products = $this->productService->getFirst();

        return view("product.show", ["products" => $products, "otherInfo" => $products['other_information']]);
    }

    public function list()
    {
        $products = $this->productService->getListAvailable();
        foreach ($products as $key => $product) {
            $otherInfo = json_decode($product['other_information'], true);
            $products[$key]['other_information'] = $otherInfo;
        }

        return view("product.list", compact("products"));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $id = $this->productService->getFirst()['id'];

        $this->productService->edit($id);

        return response()->json("Product updated successfully");
    }

    /**
     * Update the specified resource in storage.
     */
    public function create()
    {
        $product = $this->productService->create();

        if (empty($product)) {
            return response()->json("Product not created", 404);
        }

        return response()->json("Product created successfully");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete()
    {
        $product = Product::latest()->first()?->toArray();
        $this->productService->delete($product['id']);

        return response()->json("Product deleted successfully");
    }
}
