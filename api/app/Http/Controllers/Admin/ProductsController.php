<?php

namespace App\Http\Controllers\Admin;

use App\Entities\Product;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\ProductResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $products = Product::all();

        return response()->json([
            'products' => ProductResource::collection($products)
        ], Response::HTTP_ACCEPTED);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        Product::create(
            $request->only('title', 'category', 'price', 'description')
            + ['status' => Product::STATUS['approved']]
        );

        return response()->json([
            'message' => 'Product created'
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return JsonResponse
     */
    public function show(Product $product)
    {
        return response()->json([
            'product' => ProductResource::make($product)
        ], Response::HTTP_ACCEPTED);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Product $product
     * @return JsonResponse
     */
    public function update(Request $request, Product $product)
    {
        $product->update(
            $request->only('title', 'category', 'price', 'description')
        );

        return response()->json([
            'message' => 'Product updated'
        ], Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return JsonResponse
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json([
            'message' => 'Product deleted'
        ], Response::HTTP_ACCEPTED);
    }

    /**
     * @param Product $product
     * @return JsonResponse
     */
    public function accept(Product $product)
    {
        $product->update([
            'status' => Product::STATUS['approved']
        ]);

        return response()->json([
            'message' => 'Product approved'
        ], Response::HTTP_ACCEPTED);
    }

    /**
     * @param Product $product
     * @return JsonResponse
     */
    public function refuse(Product $product)
    {
        $product->update([
            'status' => Product::STATUS['unapproved']
        ]);

        return response()->json([
            'message' => 'Product unapproved'
        ], Response::HTTP_ACCEPTED);
    }
}
