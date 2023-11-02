<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function show(Request $request)
    {
        $cart = $request->session()->get('cart', []);

        if (isset($cart['products'])) {
            $cart['grosstotal'] = number_format(0, 2);
            $cart['subtotal'] = number_format(0, 2);
            $cart['taxedtotal'] = number_format(0, 2);

            foreach ($cart['products'] as $product) {
                $qty = $cart['products'][$product->id]['quantity'];
                $netprice = $cart['products'][$product->id]['netprice'];
                $cart['products'][$product->id] = Product::find($product->id);
                $cart['products'][$product->id]['quantity'] = $qty;
                $cart['products'][$product->id]['netprice'] = $netprice;

                $total = $product->price * $product->quantity;
                $taxed = $total * ($product->vat / 100);

                $cart['grosstotal'] += $total;
                $cart['subtotal'] += $total + $taxed;
                $cart['taxedtotal'] += $taxed;
            }
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
            $cart['products'][$product->id]['netprice'] = number_format($item->price + $item->price * ($item->vat / 100), 2);
        } elseif ($cart['products'][$product->id]->quantity >= $product->stock) {
            return redirect()->route('products.cart')->with('success', 'Not enough stock. Maximum item limit reached');
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

        if ($cart['products'][$product->id]->quantity > 1) {
            $cart['products'][$product->id]->quantity--;
        }

        return redirect()->route('products.cart')->with('success', 'Product removed from cart.');
    }

    public function delete(Request $request, Product $product)
    {
        $cart = $request->session()->get('cart', []);
        unset($cart['products'][$product->id]);
        $request->session()->put('cart', $cart);

        return redirect()->route('products.cart')->with('success', 'Product removed from cart.');
    }
}
