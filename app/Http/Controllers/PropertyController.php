<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use App\Http\Requests\PropertyStoreRequest;

class PropertyController extends Controller
{
    public function dashboard()
    {
        $properties = Property::paginate(10);

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

    public function edit($id)
    {
        $property = Property::find($id);

        return view('properties.edit', compact('property'));;
    }

    public function store(PropertyStoreRequest $request)
    {
        $property = new Property();
        $property->name = $request->input('name');
        return redirect()->route('dashboard.properties')->with('success', 'Nieuwe eigenschap toegevoegd');
    }

    public function update(PropertyStoreRequest $request, $id)
    {
        if ($property = Property::find($id)) {
            $property->update([
                'name' => $request->input('name'),
            ]);
            return redirect()->route('dashboard.properties')->with('success', 'Eigenschap bijgewerkt');
        } else {
            return redirect()->route('dashboard.properties')->with('error', 'Eigenschap kon niet worden bewerkt (niet gevonden)');
        }
    }

    public function delete($id)
    {
        if ($property = Property::find($id)) {
            $property->delete();
            return redirect()->route('dashboard.properties')->with('success', 'Eigenschap verwijderd');
        } else {
            return redirect()->route('dashboard.properties')->with('error', 'Eigenschap kon niet worden verwijderd (niet gevonden)');
        }
    }
}
