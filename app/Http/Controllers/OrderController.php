<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'items'             => 'required|array|min:1',
            'items.*.slug'      => 'required|string|exists:products,slug',
            'items.*.quantity'  => 'required|integer|min:1',
        ]);

        $order = Order::create([
            'user_id' => auth()->id(),
            'status'  => 'en_attente',
        ]);

        foreach ($request->items as $item) {
            $product = Product::where('slug', $item['slug'])->first();

            $order->items()->create([
                'product_id' => $product->id,
                'quantity'   => $item['quantity'],
                'price'      => $product->price,
            ]);
        }

        return response()->json([
            'message' => 'Commande créée avec succès',
            'order'   => $order->load('items.product'),
        ], 201);
    }

public function myOrders()
{
    $orders = auth()->user()
        ->orders()
        ->with('items.product')
        ->latest()
        ->get();

    return response()->json([
        'orders' => $orders
    ]);
}
//anuler
public function cancel($id)
{
    $order = Order::findOrFail($id);

    if ($order->user_id !== auth()->id()) {
        return response()->json([
            'message' => 'Action non autorisée'
        ], 403);
    }

    if ($order->status !== 'en_attente') {
        return response()->json([
            'message' => 'Impossible d\'annuler une commande déjà en préparation ou livrée'
        ], 400);
    }

    $order->update(['status' => 'annulee']);

    return response()->json([
        'message' => 'Commande annulée avec succès',
        'order'   => $order,
    ]);
}


public function prepare($id)
{
    $order = Order::findOrFail($id);

    if ($order->status !== 'en_attente') {
        return response()->json([
            'message' => 'Commande déjà en préparation ou terminée'
        ], 400);
    }

    $order->update(['status' => 'en_preparation']);

    return response()->json([
        'message' => 'Commande en préparation',
        'order'   => $order,
    ]);
}

}