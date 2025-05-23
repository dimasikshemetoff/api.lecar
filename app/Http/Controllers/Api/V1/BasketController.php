<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Basket;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BasketController extends Controller
{
    /**
     * Получить корзину текущего пользователя
     */
    public function index()
{
    $user = Auth::user();
    
    if (!$user) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    $basketItems = Basket::with('product')
        ->where('user_id', $user->id)
        ->get();
        
    return response()->json([
        'items' => $basketItems,
        'total' => $basketItems->sum('total_price')
    ]);
}

    /**
     * Добавить товар в корзину
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        
        $validator = Validator::make($request->all(), [
            'product_articul' => 'required|string|exists:products,articul',
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Получаем информацию о товаре
        $product = Product::where('articul', $request->product_articul)->first();
        
        // Проверяем, есть ли уже такой товар в корзине
        $basketItem = Basket::where('user_id', $user->id)
            ->where('product_articul', $request->product_articul)
            ->first();

        if ($basketItem) {
            // Если товар уже есть - обновляем количество
            $basketItem->quantity += $request->quantity;
            $basketItem->total_price = $basketItem->quantity * $basketItem->price_per_item;
            $basketItem->save();
        } else {
            // Если товара нет - создаем новую запись
            $basketItem = Basket::create([
                'user_id' => $user->id,
                'product_articul' => $request->product_articul,
                'quantity' => $request->quantity,
                'price_per_item' => $product->newprice,
                'total_price' => $request->quantity * $product->newprice,
            ]);
        }

        return response()->json($basketItem, 201);
    }

    /**
     * Обновить количество товара в корзине
     */
    public function update(Request $request, string $productArticul)
    {
        $user = Auth::user();
        
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $basketItem = Basket::where('user_id', $user->id)
            ->where('product_articul', $productArticul)
            ->first();

        if (!$basketItem) {
            return response()->json(['message' => 'Item not found in basket'], 404);
        }

        $basketItem->quantity = $request->quantity;
        $basketItem->total_price = $request->quantity * $basketItem->price_per_item;
        $basketItem->save();

        return response()->json($basketItem);
    }

    /**
     * Удалить товар из корзины
     */
    public function destroy(string $productArticul)
    {
        $user = Auth::user();
        
        $basketItem = Basket::where('user_id', $user->id)
            ->where('product_articul', $productArticul)
            ->first();

        if (!$basketItem) {
            return response()->json(['message' => 'Item not found in basket'], 404);
        }

        $basketItem->delete();

        return response()->json(['message' => 'Item removed from basket']);
    }

    /**
     * Очистить корзину
     */
    public function clear()
    {
        $user = Auth::user();
        
        Basket::where('user_id', $user->id)->delete();

        return response()->json(['message' => 'Basket cleared']);
    }
}