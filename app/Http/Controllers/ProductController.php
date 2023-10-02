<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create()
    {
        return view('products.create');
    }

    public function dashboard()
    {
        $products = Product::paginate(10);
        return view('products.dashboard', compact('products'));
    }
}
