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
            // zo voorkomen we dat als de client heeft gesjoemeld met sessie data...
            // die dus bijv goedkopere prijzen zou krijgen.
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

        if (!$request->has('invoice')) {
            $invoice_address = new OrderAddress();
            $invoice_address->order_id = $order->id;
            $invoice_address->type = 'invoice';
            $invoice_address->name = $request->input('invoice-name');
            $invoice_address->address = $request->input('invoice-address');
            $invoice_address->zipcode = $request->input('invoice-zipcode');
            $invoice_address->place = $request->input('invoice-place');

            $invoice_address->save();
        }


        $request->session()->put('cart', []);

        return redirect()->route('products.cart')->with('success', 'Product removed from cart.');
    }
}
