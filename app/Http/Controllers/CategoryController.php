<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryStoreRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function dashboard()
    {
        $categories = Category::paginate(10);

        return view('categories.dashboard', compact('categories'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $categories = Category::where('name', 'LIKE', "%$query%")->paginate(10)->appends(['query' => $query]);

        return view('categories.dashboard', compact('categories'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('categories.create', compact('categories'));
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));;
    }

    public function store(CategoryStoreRequest $request)
    {
        $category = new Category;
        $category->name = $request->input('name');
        $category->save();

        return redirect()->route('dashboard.categories')->with('success', 'Nieuwe categorie toegevoegd');
    }

    public function update(CategoryStoreRequest $request, Category $category)
    {
        $category->update([
            'name' => $request->input('name'),
        ]);
        return redirect()->route('dashboard.categories')->with('success', 'Categorie bijgewerkt');
    }

    public function delete(Category $category)
    {
        $category->delete();
        return redirect()->route('dashboard.categories')->with('success', 'Categorie verwijderd');
    }
}
