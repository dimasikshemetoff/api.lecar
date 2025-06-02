<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with(['products', 'user'])
            ->latest()
            ->paginate(10);

        return response()->json($orders);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'payment_method' => 'required|string|in:cash,card,online',
            'email' => 'nullable|email',
            'products' => 'required|array',
            'products.*.articul' => 'required|exists:products,articul',
            'products.*.quantity' => 'required|integer|min:1',
            'products.*.price' => 'required|numeric|min:0',
        ]);

        $total = 0;
        $products = [];
        
        foreach ($validated['products'] as $item) {
            $product = Product::where('articul', $item['articul'])->first();
            $price = $item['price'];
            $quantity = $item['quantity'];
            $total += $price * $quantity;
            
            $products[$product->id] = [
                'quantity' => $quantity,
                'price' => $price
            ];
        }

        $order = Order::create([
            'user_id' => $validated['user_id'] ?? Auth::id(),
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'total' => $total,
            'status' => 'pending',
            'payment_method' => $validated['payment_method'],
            'email' => $validated['email'] ?? null,
        ]);

        $order->products()->sync($products);

        return response()->json($order->load('products'), 201);
    }

    public function show(string $id)
    {
        $order = Order::with(['products', 'user'])
            ->when(Auth::user()->is_admin === false, function ($query) {
                return $query->where('user_id', Auth::id());
            })
            ->findOrFail($id);

        return response()->json($order);
    }

    public function update(Request $request, string $id)
    {
        $order = Order::findOrFail($id);

        if (!Auth::user()->is_admin) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'status' => 'required|string|in:pending,processing,completed,cancelled',
        ]);

        $order->update($validated);

        return response()->json($order);
    }

    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);

        if (!Auth::user()->is_admin && $order->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $order->delete();

        return response()->json(null, 204);
    }
}