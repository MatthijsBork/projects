<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function create()
    {
        return view('projects.create');
    }

    public function dashboard()
    {
        $projects = Project::paginate(10);

        return view('projects.dashboard', compact('projects'));
    }

    public function edit()
    {
        $projects = [];
        return view('projects.edit', compact('projects'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $projects = Project::where('name', 'LIKE', "%$query%")->paginate(10)->appends(['query' => $query]);

        return view('projects.dashboard', compact('projects'));
    }
}
