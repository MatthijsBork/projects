<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductProperty;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProductStoreRequest;

class ProductController extends Controller
{
    public function dashboard()
    {
        $products = Product::paginate(10);

        return view('products.dashboard', compact('products'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $products = Product::where('title', 'LIKE', "%$query%")->paginate(10)->appends(['query' => $query]);

        return view('products.dashboard', compact('products'));
    }

    public function create()
    {
        $product = new Product;
        return view('products.create', compact('product'));
    }

    public function edit(Request $request, Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function store(ProductStoreRequest $request)
    {
        $product = new Product;
        $product->title = $request->input('title');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->stock = $request->input('stock');
        $product->vat = $request->input('vat');
        $product->save();

        if ($properties = $request->input('properties')) {
            foreach ($properties as $propertyId => $value) {
                ProductProperty::create([
                    'property_id' => $propertyId,
                    'product_id' => $product->id,
                    'value' => $value,
                ]);
            }
        }

        if ($request->hasFile('image')) {

            $imageName = $product->id . '.' . $request->file('image')->extension();
            $request->file('image')->storeAs('products/' . $product->id, $imageName);
            $product->img = $imageName;
            $product->save();
        }

        return redirect()->route('dashboard.products')->with('success', 'Product opgeslagen');
    }

    public function update(ProductStoreRequest $request, Product $product)
    {
        if ($request->hasFile('image')) {
            if ($product->img) {
                Storage::delete('products/' . $product->id . '/' . $product->img);
            }
            $imageName = $product->id . '.' . $request->file('image')->extension();
            $request->file('image')->storeAs('products/' . $product->id, $imageName);
            $product->img = $imageName;
            $product->save();
        }

        $product->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'stock' => $request->input('stock'),
            'vat' => $request->input('vat'),
            'img' => $imageName ?? null,
        ]);

        if ($properties = $request->input('properties')) {
            foreach ($properties as $propertyId => $value) {
                $property = $product->properties->first(function ($property) use ($propertyId) {
                    return $property->property_id === $propertyId;
                });

                if ($property) {
                    $value == null ? $property->delete() :
                        $property->update([
                            'value' => $value,
                        ]);
                } elseif ($value) {
                    ProductProperty::create([
                        'property_id' => $propertyId,
                        'product_id' => $product->id,
                        'value' => $value,
                    ]);
                }
            }
        }
        return redirect()->route('dashboard.products')->with('success', 'Product bijgewerkt');
    }

    public function delete(Product $product)
    {
        Storage::delete('products/' . $product->id . '/' . $product->img);
        Storage::deleteDirectory('products/' . $product->id);
        $product->delete();
        return redirect()->route('dashboard.products')->with('success', 'Product verwijderd');
    }
}
