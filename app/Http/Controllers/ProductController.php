<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // =========================
    // GET ALL PRODUCTS
    // =========================
    public function index()
    {
        return response()->json([
            'data' => Product::all()
        ]);
    }

    // =========================
    // GET SINGLE PRODUCT
    // =========================
    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'message' => 'Product not found'
            ], 404);
        }

        return response()->json([
            'data' => $product
        ]);
    }

    // =========================
    // CREATE PRODUCT
    // =========================
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|string', // ✅ FIXED (optional now)
        ]);

        $product = Product::create([
            'name'  => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $request->image ?? null,
        ]);

        return response()->json([
            'message' => 'Product created successfully',
            'data' => $product
        ], 201);
    }

    // =========================
    // UPDATE PRODUCT
    // =========================
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'message' => 'Product not found'
            ], 404);
        }

        $product->update([
            'name'  => $request->name ?? $product->name,
            'price' => $request->price ?? $product->price,
            'stock' => $request->stock ?? $product->stock,
            'image' => $request->image ?? $product->image,
        ]);

        return response()->json([
            'message' => 'Product updated successfully',
            'data' => $product
        ]);
    }

    // =========================
    // DELETE PRODUCT
    // =========================
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'message' => 'Product not found'
            ], 404);
        }

        $product->delete();

        return response()->json([
            'message' => 'Product deleted successfully'
        ]);
    }
}