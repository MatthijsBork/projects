<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use App\Http\Requests\PropertyStoreRequest;

class PropertyController extends Controller
{
    public function dashboard()
    {
        $properties = Property::orderBy('created_at', 'desc')->paginate(10);

        return view('properties.dashboard', compact('properties'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $properties = Property::where('name', 'LIKE', "%$query%")->paginate(10)->appends(['query' => $query]);

        return view('properties.dashboard', compact('properties'));
    }

    public function create()
    {
        $properties = Property::all();

        return view('properties.create', compact('properties'));
    }

    public function edit(Property $property)
    {
        return view('properties.edit', compact('property'));;
    }

    public function store(PropertyStoreRequest $request)
    {
        $property = new Property();
        $property->name = $request->input('name');
        $property->save();
        return redirect()->route('dashboard.properties')->with('success', 'Nieuwe eigenschap toegevoegd');
    }

    public function update(PropertyStoreRequest $request, Property $property)
    {
        $property->update([
            'name' => $request->input('name'),
        ]);
        return redirect()->route('dashboard.properties')->with('success', 'Eigenschap bijgewerkt');
    }

    public function delete(Property $property)
    {
        $property->delete();
        return redirect()->route('dashboard.properties')->with('success', 'Eigenschap verwijderd');
    }
}
