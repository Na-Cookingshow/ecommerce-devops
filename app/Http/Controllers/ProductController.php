<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // GET ALL PRODUCTS
    public function index()
    {
        return Product::all();
    }

    // CREATE PRODUCT
    public function store(Request $request)
    {
        $product = Product::create($request->all());

        return response()->json($product, 201);
    }

    // GET SINGLE PRODUCT
    public function show(string $id)
    {
        return Product::findOrFail($id);
    }

    // UPDATE PRODUCT
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $product->update($request->all());

        return response()->json($product);
    }

    // DELETE PRODUCT
    public function destroy(string $id)
    {
        Product::destroy($id);

        return response()->json([
            'message' => 'Product deleted'
        ]);
    }
}