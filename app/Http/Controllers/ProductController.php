<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProductStoreRequest;
use App\Models\ProductProperty;

class ProductController extends Controller
{
    public function create()
    {
        $product = new Product;
        return view('products.create', compact('product'));
    }

    public function dashboard()
    {
        $products = Product::paginate(10);

        return view('products.dashboard', compact('products'));
    }

    public function edit(Request $request, $id)
    {
        if ($product = Product::find($id)) {


            return view('products.edit', compact('product'));
        } else {
            return redirect()->route('dashboard.products')->with('error', 'Product kon niet worden bewerkt (niet gevonden)');
        }
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $products = Product::where('title', 'LIKE', "%$query%")->paginate(10)->appends(['query' => $query]);

        return view('products.dashboard', compact('products'));
    }

    public function store(ProductStoreRequest $request)
    {
        try {
            $product = new Product();
            $product->title = $request->input('title');
            $product->description = $request->input('description');
            $product->price = $request->input('price');
            $product->stock = $request->input('stock');
            $product->vat = $request->input('vat');

            $properties = $request->input('properties');

            $product->save();

            foreach ($properties as $propertyId => $value) {
                ProductProperty::create([
                    'property_id' => $propertyId,
                    'product_id' => $product->id,
                    'value' => $value,
                ]);
            }


            if ($request->hasFile('image')) {
                if ($product->image_name) {
                    Storage::delete('products/' . $product->id . '/' . $product->image_name);
                }
                $imageName = $product->id . '.' . $request->file('image')->extension();
                $request->file('image')->storeAs('products/' . $product->id, $imageName);
                $product->image_name = $imageName;
                $product->save();
            }
            return redirect()->route('dashboard.products', [$product->id])->with('success', 'Product opgeslagen');
        } catch (\Exception $e) {
            return redirect()->route('dashboard.products.create', ['product' => new Product()])
                ->withInput()
                ->with('error', 'Er is iets misgegaan' . $e);
        }
    }

    public function delete($id)
    {
        if ($product = Product::find($id)) {
            Storage::delete('products/' . $product->id . '/' . $product->image_name);
            Storage::deleteDirectory('products/' . $product->id);
            $product->delete();
            return redirect()->route('dashboard.products')->with('success', 'Product verwijderd');
        } else {
            return redirect()->route('dashboard.products')->with('error', 'Product kon niet worden verwijderd (niet gevonden)');
        }
    }

    public function update(ProductStoreRequest $request, $id)
    {
        if ($product = Product::find($id)) {
            if ($request->hasFile('image')) {
                if ($product->image_name) {
                    Storage::delete('products/' . $product->id . '/' . $product->image_name);
                }
                $imageName = $product->id . '.' . $request->file('image')->extension();
                $request->file('image')->storeAs('products/' . $product->id, $imageName);
                $product->image_name = $imageName;
                $product->save();
            }
            $product->update([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'price' => $request->input('price'),
                'stock' => $request->input('stock'),
                'vat' => $request->input('vat'),
                'image_name' => $imageName ?? null,
            ]);
            $properties = $request->input('properties');

            foreach ($properties as $propertyId => $value) {
                ProductProperty::create([
                    'property_id' => $propertyId,
                    'product_id' => $product->id,
                    'value' => $value,
                ]);
            }
            return redirect()->route('dashboard.products')->with('success', 'Product bijgewerkt');
        } else {
            return redirect()->route('dashboard.products')->with('error', 'Product kon niet worden bewerkt (niet gevonden)');
        }
    }
}
