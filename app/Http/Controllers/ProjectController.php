<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProjectStoreRequest;
use App\Models\ProjectUserRole;

class ProjectController extends Controller
{
    public function dashboard()
    {
        $projects = Project::paginate(10);

        return view('projects.dashboard', compact('projects'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $projects = Project::where('title', 'LIKE', "%$query%")->paginate(10)->appends(['query' => $query]);

        return view('projects.dashboard', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function edit(Request $request, Project $project)
    {
        $roles = Role::all();
        $users = User::all();
        $userroles = ProjectUserRole::where('project_id', '=', $project->id)->get();

        return view('projects.edit', compact('project', 'users', 'userroles', 'roles'));
    }

    public function store(ProjectStoreRequest $request)
    {
        $project = new Project;
        $project->title = $request->input('title');
        $project->description = $request->input('description');
        $project->start_date = Carbon::parse($request->input('start_date'));
        $project->save();

        if ($request->hasFile('image')) {
            if ($project->img) {
                Storage::delete('projects/' . $project->id . '/' . $project->img);
            }
            $imageName = $project->id . '.' . $request->file('image')->extension();
            $request->file('image')->storeAs('projects/' . $project->id, $imageName);
            $project->img = $imageName;
            $project->save();
        }
        return redirect()->route('dashboard.projects.edit', [$project->id])->with('success', 'Project opgeslagen');
    }

    public function update(ProjectStoreRequest $request, Project $project)
    {
        if ($request->hasFile('image')) {
            if ($project->img) {
                Storage::delete('projects/' . $project->id . '/' . $project->img);
            }
            $imageName = $project->id . '.' . $request->file('image')->extension();
            $request->file('image')->storeAs('projects/' . $project->id, $imageName);
            $project->img = $imageName;
            $project->save();
        }
        $project->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'start_date' => Carbon::parse($request->input('start_date')),
            'img' => $imageName ?? null,
        ]);
        return redirect()->route('dashboard.projects')->with('success', 'Project bijgewerkt');
    }

    public function delete(Project $project)
    {
        Storage::delete('projects/' . $project->id . '/' . $project->img);
        Storage::deleteDirectory('projects/' . $project->id);
        $project->delete();
        return redirect()->route('dashboard.projects')->with('success', 'Project verwijderd');
    }
}
