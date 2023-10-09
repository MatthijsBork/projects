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

    public function edit($id)
    {
        $category = Category::find($id);

        return view('categories.edit', compact('category'));;
    }

    public function store(CategoryStoreRequest $request)
    {
        $category = new Category;
        $category->name = $request->input('name');
        $category->save();

        return redirect()->route('dashboard.categories')->with('success', 'Nieuwe categorie toegevoegd');
    }

    public function update(CategoryStoreRequest $request, $id)
    {
        if ($category = Category::find($id)) {
            $category->update([
                'name' => $request->input('name'),
            ]);
            return redirect()->route('dashboard.categories')->with('success', 'Categorie bijgewerkt');
        } else {
            return redirect()->route('dashboard.categories')->with('error', 'Categorie kon niet worden bewerkt (niet gevonden)');
        }
    }

    public function delete($id)
    {
        if ($category = Category::find($id)) {
            $category->delete();
            return redirect()->route('dashboard.categories')->with('success', 'Categorie verwijderd');
        } else {
            return redirect()->route('dashboard.categories')->with('error', 'Categorie kon niet worden verwijderd (niet gevonden)');
        }
    }
}
