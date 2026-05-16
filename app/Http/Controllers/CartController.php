<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Request $request, Product $product)
    {
        $cart = session()->get('cart', []);
        $id = $product->id;

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'name'     => $product->name,
                'price'    => $product->price,
                'quantity' => 1,
                'image'    => $product->image,
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', $product->name . ' ajouté au panier !');
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);
        unset($cart[$id]);
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Produit retiré du panier.');
    }

    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Panier vide.');
        }

        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        $order = Order::create([
            'user_id' => auth()->id(),
            'total'   => $total,
            'status'  => 'pending',
            'address' => $request->address ?? 'Cotonou, Bénin',
        ]);

        foreach ($cart as $id => $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $id,
                'quantity'   => $item['quantity'],
                'price'      => $item['price'],
            ]);
        }

        session()->forget('cart');
        return redirect()->route('products.index')
                         ->with('success', 'Commande #' . $order->id . ' passée avec succès !');
    }
}