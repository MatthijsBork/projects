<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderAddress;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Requests\OrderStoreRequest;

class OrderController extends Controller
{

    public function dashboard()
    {
        $orders = Order::orderBy('created_at', 'desc')->paginate(10);

        return view('orders.dashboard', compact('orders'));
    }

    public function own()
    {
        $user = auth()->user();
        $orders = $user->orders()->paginate(10);

        return view('orders.own', compact('orders'));
    }

    public function show(Order $order)
    {
        $this->authorize('hasOrder', [Order::class, $order]);
        return view('orders.show', compact('order'));
    }

    public function showProducts(Order $order)
    {
        return view('orders.products', compact('order'));
    }

    public function create()
    {
        return view('orders.create');
    }

    public function edit(Order $order)
    {
        return view('orders.edit', compact('order'));
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

        $request->session()->put('cart', $cart);

        return view('products.orders.order', compact('cart'));
    }

    public function orderConfirm(OrderStoreRequest $request)
    {
        $request->session()->put('order', $request->all());

        $order = $request->session()->get('order', []);
        $cart = $request->session()->get('cart', []);

        return view('products.orders.confirmation', compact('cart', 'order'));
    }

    public function store(Request $request)
    {
        $orderData = $request->session()->get('order', []);

        $order = new Order();
        $order->user_id = isset(auth()->user()->id) ? auth()->user()->id : null;
        $order->email = $orderData['email'];
        $order->telephone = $orderData['telephone'];

        $order->gross_total = 0;
        $order->net_total = 0;
        $order->taxed_total = 0;
        $order->save();

        $cart = $request->session()->get('cart', []);

        foreach ($cart['products'] as $product) {
            $order_product = new OrderProduct();

            $quantity = $product->quantity;

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
        $address->name = $orderData['name'];
        $address->address = $orderData['address'];
        $address->zipcode = $orderData['zipcode'];
        $address->place = $orderData['place'];

        $address->save();

        if (!isset($orderData['invoice'])) {
            $invoice_address = new OrderAddress();
            $invoice_address->order_id = $order->id;
            $invoice_address->type = 'invoice';
            $invoice_address->name = $orderData['invoice-name'];
            $invoice_address->address = $orderData['invoice-address'];
            $invoice_address->zipcode = $orderData['invoice-zipcode'];
            $invoice_address->place = $orderData['invoice-place'];

            $invoice_address->save();
        }

        session()->forget('order');
        session()->forget('cart');

        return redirect()->route('products.index')->with('success', 'Producten besteld.');
    }

    public function update(OrderStoreRequest $order)
    {
        $order->update();
    }

    public function delete(Order $order)
    {
        $order->delete();
        return redirect()->route('dashboard.orders')->with('success', 'Bestelling verwijderd');
    }

    public function downloadPDF(Order $order)
    {
        $pdf = Pdf::loadView('orders.pdf', compact('order'));

        $filename = 'order_' . $order->id . '.pdf';

        return $pdf->download($filename);
    }
}
