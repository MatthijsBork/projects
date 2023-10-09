<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleStoreRequest;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function create()
    {
        $roles = Role::all();

        return view('roles.create', compact('roles'));
    }

    public function store(RoleStoreRequest $request)
    {
        $role = new Role();
        $role->name = $request->input('name');
        $role->save();

        return redirect()->route('dashboard.roles')->with('success', 'Nieuwe rol toegevoegd');
    }

    public function dashboard()
    {
        $roles = Role::paginate(10);

        return view('roles.dashboard', compact('roles'));
    }

    public function edit($id)
    {
        $role = Role::find($id);

        return view('roles.edit', compact('role'));;
    }

    public function update(RoleStoreRequest $request, $id)
    {
        if ($role = Role::find($id)) {
            $role->update([
                'name' => $request->input('name'),
            ]);
            return redirect()->route('dashboard.roles')->with('success', 'Rol bijgewerkt');
        } else {
            return redirect()->route('dashboard.roles')->with('error', 'Rol kon niet worden bewerkt (niet gevonden)');
        }
    }

    public function delete($id)
    {
        if ($role = Role::find($id)) {
            $role->delete();
            return redirect()->route('dashboard.roles')->with('success', 'Rol verwijderd');
        } else {
            return redirect()->route('dashboard.roles')->with('error', 'Rol kon niet worden verwijderd (niet gevonden)');
        }
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $roles = Role::where('name', 'LIKE', "%$query%")->paginate(10)->appends(['query' => $query]);

        return view('roles.dashboard', compact('roles'));
    }
}
