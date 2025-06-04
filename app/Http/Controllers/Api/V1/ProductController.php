<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'image' => 'nullable|string',
            'manufactured' => 'required|string|max:255',
            'description' => 'required|string',
            'newprice' => 'required|numeric|min:0',
            'isfavorite' => 'boolean',
            'prescription_required' => 'boolean',
            'oldprice' => 'nullable|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $product = Product::create([
            'articul' => $request->articul,
            'title' => $request->title,
            'category' => $request->category,
            'image' => $request->image,
            'manufactured' => $request->manufactured,
            'description' => $request->description,
            'newprice' => $request->newprice,
            'isfavorite' => $request->isfavorite ?? false,
            'prescription_required' => $request->prescription_required ?? false,
            'oldprice' => $request->oldprice,
        ]);

        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $articul)
    {
        $product = Product::where('articul', $articul)->first();
        
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $articul)
    {
        $product = Product::where('articul', $articul)->first();
        
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|string|max:255',
            'category' => 'sometimes|string|max:255',
            'image' => 'nullable|string',
            'manufactured' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'newprice' => 'sometimes|numeric|min:0',
            'isfavorite' => 'boolean',
            'prescription_required' => 'boolean',
            'oldprice' => 'nullable|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $product->update($request->all());

        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $articul)
    {
        $product = Product::where('articul', $articul)->first();
        
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'Product deleted successfully']);
    }
}