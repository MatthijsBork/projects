<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create()
    {
        $categories = Category::all();

        return view('categories.create', ['categories' => $categories]);
    }

    public function post(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:32',
        ]);

        try {
            Category::create([
                'name' => $request->input('name')
            ]);
            return redirect()->route('categories.dashboard')->with('success', 'Nieuwe categorie toegevoegd');
        } catch (\Exception $e) {
            return redirect()->route('categories.create', ['category' => new Category()])->withInput()->with('error', 'Er is iets mis gegaan bij het maken van een nieuw artikel');
        }
    }

    public function dashboard()
    {
        $categories = Category::all();

        return view('categories.dashboard', ['categories' => $categories]);
    }

    public function edit(Request $request, $id)
    {
        if ($request->isMethod('get') && ($category = Category::find($id))) {
            return view('categories.edit', ['category' => $category]);;
        } elseif ($request->isMethod('post') && ($category = Category::find($id))) {
            $request->validate([
                'name' => 'required|string|max:32',
            ]);

            $category->update([
                'name' => $request->input('name'),
            ]);
            return redirect()->route('categories.dashboard')->with('success', 'Categorie bijgewerkt');
        } else {
            return redirect()->route('categories.dashboard')->with('error', 'Categorie kon niet worden bewerkt (niet gevonden)');
        }
    }

    public function delete($id)
    {
        if ($category = Category::find($id)) {
            $category->delete();
            return redirect()->route('categories.dashboard')->with('success', 'Categorie verwijderd');
        } else {
            return redirect()->route('categories.dashboard')->with('error', 'Categorie kon niet worden verwijderd (niet gevonden)');
        }
    }
}
