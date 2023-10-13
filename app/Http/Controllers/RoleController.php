<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleStoreRequest;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function dashboard()
    {
        $roles = Role::paginate(10);

        return view('roles.dashboard', compact('roles'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $roles = Role::where('name', 'LIKE', "%$query%")->paginate(10)->appends(['query' => $query]);

        return view('roles.dashboard', compact('roles'));
    }

    public function create()
    {
        $roles = Role::all();

        return view('roles.create', compact('roles'));
    }

    public function edit(Role $role)
    {
        return view('roles.edit', compact('role'));;
    }

    public function store(RoleStoreRequest $request)
    {
        $role = new Role();
        $role->name = $request->input('name');
        $role->save();

        return redirect()->route('dashboard.roles')->with('success', 'Nieuwe rol toegevoegd');
    }

    public function update(RoleStoreRequest $request, Role $role)
    {
        $role->update([
            'name' => $request->input('name'),
        ]);
        return redirect()->route('dashboard.roles')->with('success', 'Rol bijgewerkt');
    }

    public function delete(Role $role)
    {
        $role->delete();
        return redirect()->route('dashboard.roles')->with('success', 'Rol verwijderd');
    }
}
