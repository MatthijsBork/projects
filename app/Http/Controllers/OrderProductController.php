<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderProduct;
use Illuminate\Http\Request;

class OrderProductController extends Controller
{
    public function store(Request $request, Order $order)
    {
        $product = Product::find($request->input('product_id'));

        // OrderProduct maken
        $order_product = new OrderProduct();
        $order_product->order_id = $order->id;
        $order_product->amount = $request->input('quantity');
        $order_product->price = $product->price;
        $order_product->vat = $product->vat;
        $order_product->product_id = $product->id;
        $order_product->save();

        // Totalen berekenen
        $total = $product->price * $request->input('quantity');
        $order->gross_total += $total;
        $order->net_total += $total + $total * ($product->vat / 100);
        $order->taxed_total += $total * ($product->vat / 100);
        $order->save();

        return redirect()->route('dashboard.orders.edit.products', compact('order'));
    }

    public function add(Request $request, Order $order, OrderProduct $product)
    {
        // Product => OrderProduct
        $product->addOne();
        return redirect()->route('dashboard.orders.edit.products', compact('order'));
    }

    public function subtract(Request $request, Order $order, OrderProduct $product)
    {
        // Product => OrderProduct
        $product->subtractOne();
        return redirect()->route('dashboard.orders.edit.products', compact('order'));
    }

    public function delete(Order $order, Product $product)
    {
        dd('test');
        $product->delete();
        return redirect()->route('dashboard.orders.edit.products', compact('order'));
    }

    public function edit(Order $order)
    {
        $products = $order->productsNotInOrder();
        return view('orders.editProducts', compact('order', 'products'));
    }

    private function calculateTotals(Order $order)
    {

        $gross = 0;
        $net = 0;
        $taxed = 0;
        foreach ($order->products() as $product) {

        }
    }
}
