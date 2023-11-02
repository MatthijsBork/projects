<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use App\Http\Requests\OrderProductStoreRequest;

class OrderProductController extends Controller
{
    public function store(OrderProductStoreRequest $request, Order $order)
    {
        $product = Product::find($request->input('product_id'));

        if ($request->input('quantity') > $product->stock || $request->input('quantity') < 1) {
            return redirect()->route('dashboard.orders.edit.products', compact('order'))->with('error', 'Niet genoeg voorraad, verlaag het aantal');
        } elseif ($request->input('quantity') < 1) {
            $quantity = 1;
        } else {
            $quantity = $request->input('quantity');
        }
        $order_product = new OrderProduct();
        $order_product->order_id = $order->id;
        $order_product->amount = $quantity;
        $order_product->price = $product->price;
        $order_product->vat = $product->vat;
        $order_product->product_id = $product->id;
        $order_product->save();

        $order->calculateTotals();
        $order->save();

        return redirect()->route('dashboard.orders.edit.products', compact('order'));
    }

    public function show(Order $order)
    {
        return view('orders.products', compact('order'));
    }


    public function add(Request $request, Order $order, OrderProduct $product)
    {
        // Product => OrderProduct
        $product->addOne();
        $order->calculateTotals();
        $order->save();
        return redirect()->route('dashboard.orders.edit.products', compact('order'));
    }

    public function subtract(Request $request, Order $order, OrderProduct $product)
    {
        // Product => OrderProduct
        $product->subtractOne();
        $order->calculateTotals();
        $order->save();
        return redirect()->route('dashboard.orders.edit.products', compact('order'));
    }

    public function delete(Order $order, OrderProduct $product)
    {
        $product->delete();
        $order->calculateTotals();
        $order->save();
        return redirect()->route('dashboard.orders.edit.products', compact('order'));
    }

    public function edit(Order $order)
    {
        $products = $order->productsNotInOrder();
        return view('orders.editProducts', compact('order', 'products'));
    }
}
