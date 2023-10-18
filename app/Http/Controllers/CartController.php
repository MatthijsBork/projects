<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function show(Request $request)
    {
        $cart = $request->session()->get('cart', []);

        $cart['grosstotal'] = 0;
        $cart['subtotal'] = 0;
        $cart['taxedtotal'] = 0;

        foreach ($cart['products'] as $item) {
            $itemtotal = $item->price * $item->quantity;
            $itemtaxed = $itemtotal * ($item->vat / 100);

            $cart['grosstotal'] += $itemtotal;
            $cart['taxedtotal'] += $itemtaxed;
            $cart['subtotal'] += $itemtotal + $itemtaxed;
        }

        return view('products.orders.cart', compact('cart'));
    }

    public function add(Request $request, Product $product)
    {
        // Get the current cart from the session or create an empty cart
        $cart = $request->session()->get('cart', []);

        // Add the product to the cart
        if (!isset($cart['products'][$product->id])) {
            $cart['products'][$product->id] = $product;
            $cart['products'][$product->id]['quantity'] = 1;
            $item = $cart['products'][$product->id];
            $cart['products'][$product->id]['netprice'] = $item->price + $item->price * ($item->vat / 100);
        } else {
            $cart['products'][$product->id]->quantity++;
        }

        // Store the updated cart in the session
        $request->session()->put('cart', $cart);

        return redirect()->route('products.cart')->with('success', 'Product added to cart.');
    }

    public function subtract(Request $request, Product $product)
    {
        $cart = $request->session()->get('cart', []);

        $cart['products'][$product->id]->quantity > 1 ? $cart['products'][$product->id]->quantity-- : $this->delete($request, $product);

        return redirect()->route('products.cart')->with('success', 'Product removed from cart.');
    }

    public function delete(Request $request, Product $product)
    {
        $cart = $request->session()->get('cart', []);
        unset($cart['products'][$product->id]);
        $request->session()->put('cart', $cart);

        return redirect()->route('products.cart')->with('success', 'Product removed from cart.');
    }

    public function order(Request $request)
    {
        $cart = $request->session()->get('cart', []);

        $cart['grosstotal'] = 0;
        $cart['subtotal'] = 0;
        $cart['taxedtotal'] = 0;

        foreach ($cart['products'] as $item) {
            $itemtotal = $item->price * $item->quantity;
            $itemtaxed = $itemtotal * ($item->vat / 100);

            $cart['grosstotal'] += $itemtotal;
            $cart['taxedtotal'] += $itemtaxed;
            $cart['subtotal'] += $itemtotal + $itemtaxed;
        }
        return view('products.orders.order', compact('cart'));
    }

    public function checkout(Request $request) {

    }
}
