<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderAddress;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use App\Http\Requests\OrderStoreRequest;

class OrderController extends Controller
{
    public function store(OrderStoreRequest $request)
    {
        $order = new Order();
        $order->user_id = isset(auth()->user()->id) ? auth()->user()->id : null;
        $order->email = $request->input('email');
        $order->telephone = $request->input('telephone');

        $order->gross_total = 0;
        $order->net_total = 0;
        $order->taxed_total = 0;
        $order->save();


        $cart = $request->session()->get('cart', []);

        foreach ($cart['products'] as $product) {
            $order_product = new OrderProduct();

            $quantity = $product->quantity;

            // We halen het product opnieuw op...
            // zo voorkomen we dat de client heeft gesjoemeld met sessie data...
            // en dus evt goedkopere prijzen zou krijgen.
            $product = Product::find($product->id);

            $order_product->order_id = $order->id;
            $order_product->amount = $quantity;
            $order_product->price = $product->price;
            $order_product->vat = $product->vat;
            $order_product->product_id = $product->id;

            $total = $product->price * $quantity;
            $order->gross_total += $total;
            $order->net_total += $total + $total * ($product->vat / 100);
            $order->taxed_total += $total * ($product->vat / 100);
        }
        $order->save();
        $order_product->save();

        $address = new OrderAddress();
        $address->order_id = $order->id;
        $address->type = 'shipping';
        $address->name = $request->input('name');
        $address->address = $request->input('address');
        $address->zipcode = $request->input('zipcode');
        $address->place = $request->input('place');

        $address->save();

        $request->session()->put('cart', []);

        return redirect()->route('products.cart')->with('success', 'Product removed from cart.');
    }
}
