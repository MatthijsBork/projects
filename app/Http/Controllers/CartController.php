<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function show()
    {
        return view('products.orders.cart');
    }

    public function add(Request $request, Product $product)
    {
        // Get the current cart from the session or create an empty cart
        $cart = $request->session()->get('cart', []);

        // Add the product to the cart
        $cart[] = [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
        ];

        // Store the updated cart in the session
        $request->session()->put('cart', $cart);

        dd($cart = $request->session()->get('cart', []));

        return redirect()->route('products.index')->with('success', 'Product added to cart.');
    }
}
