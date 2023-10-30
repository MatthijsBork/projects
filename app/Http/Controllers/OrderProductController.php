<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderProduct;
use Illuminate\Http\Request;

class OrderProductController extends Controller
{
    public function add(Request $request, Order $order)
    {

        $product_id = $request->input('product_id');

        $order_product = new OrderProduct();

        $quantity = $request->input('quantity');

        // We halen het product opnieuw op...
        // zo voorkomen we dat als de client heeft gesjoemeld met sessie data...
        // die dus bijv goedkopere prijzen zou krijgen.
        $product = Product::find($product_id);

        $order_product->order_id = $order->id;
        $order_product->amount = $quantity;
        $order_product->price = $product->price;
        $order_product->vat = $product->vat;
        $order_product->product_id = $product->id;

        $total = $product->price * $quantity;
        $order->gross_total += $total;
        $order->net_total += $total + $total * ($product->vat / 100);
        $order->taxed_total += $total * ($product->vat / 100);

        $order->save();
        $order_product->save();


        $products = Product::all();
        return redirect()->route('dashboard.orders.edit.products', compact('order', 'products'))->with('success', 'Producten toegevoegd.');
    }

    public function edit(Order $order)
    {
        $products = Product::all();
        return view('orders.editProducts', compact('order', 'products'));
    }

    public function subtract(Order $order)
    {
        $products = Product::all();
        return view('orders.editProducts', compact('order', 'products'));
    }

    public function delete(Order $order)
    {
        $products = Product::all();
        return view('orders.editProducts', compact('order', 'products'));
    }
}
