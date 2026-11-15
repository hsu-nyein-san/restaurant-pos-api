<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products=Product::with('category')->latest()->get();

        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $validated=$request->validated();

        $product=Product::create($validated);

        return response()->json([
            'message'=>'Product Created Successfully',
            'data'=>new ProductResource($product->load('category'))
        ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return new ProductResource($product->load('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $validated=$request->validated();

        $product->update($validated);

        return response()->json([
            'message'=>'Product Updated Successfully',
            'data'=>new ProductResource($product->load('category')->fresh())
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json([
            'message'=>'Product Deleted Successfully'
        ],200);
    }
}
