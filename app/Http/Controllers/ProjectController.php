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
    public function create()
    {
        return view('projects.create');
    }

    public function dashboard()
    {
        $projects = Project::paginate(10);

        return view('projects.dashboard', compact('projects'));
    }

    public function edit(Request $request, $id)
    {
        if ($project = Project::find($id)) {
            $roles = Role::all();
            $users = User::all();
            $userroles = ProjectUserRole::where('project_id', '=', $project->id)->get();

            return view('projects.edit', compact('project', 'users', 'userroles', 'roles'));
        } else {
            return redirect()->route('dashboard.projects')->with('error', 'Project kon niet worden bewerkt (niet gevonden)');
        }
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $projects = Project::where('title', 'LIKE', "%$query%")->paginate(10)->appends(['query' => $query]);

        return view('projects.dashboard', compact('projects'));
    }

    public function store(ProjectStoreRequest $request)
    {
        try {
            $project = new Project();
            $project->title = $request->input('title');
            $project->description = $request->input('description');
            $project->start_date = Carbon::parse($request->input('start_date'));

            $project->save();

            if ($request->hasFile('image')) {
                if ($project->image) {
                    Storage::delete('projects/' . $project->id . '/' . $project->image);
                }
                $imageName = $project->id . '.' . $request->file('image')->extension();
                $request->file('image')->storeAs('projects/' . $project->id, $imageName);
                $project->image_name = $imageName;
                $project->save();
            }
            return redirect()->route('dashboard.projects.roles', [$project->id]);
        } catch (\Exception $e) {
            return redirect()->route('dashboard.projects.create', ['project' => new Project()])
                ->withInput()
                ->with('error', 'Er is iets misgegaan' . $e);
        }
    }

    public function delete($id)
    {
        if ($project = Project::find($id)) {
            Storage::delete('projects/' . $project->id . '/' . $project->image_name);
            Storage::deleteDirectory('projects/' . $project->id);
            $project->delete();
            return redirect()->route('dashboard.projects')->with('success', 'Project verwijderd');
        } else {
            return redirect()->route('dashboard.projects')->with('error', 'Project kon niet worden verwijderd (niet gevonden)');
        }
    }

    public function update(ProjectStoreRequest $request, $id)
    {
        if ($project = Project::find($id)) {
            if ($request->input('delete_image') == 1) {
                Storage::delete('projects/' . $project->id . '/' . $project->image_name);
                Storage::deleteDirectory('projects/' . $project->id);
                $imagePath = '';
            } elseif ($request->hasFile('image')) {
                Storage::delete('projects/' . $project->id . '/' . $project->image_name);
                Storage::deleteDirectory('projects/' . $project->id);
                $p = 'public';
                $path = $request->file('image')->store($p, 'public');
                $imagePath = substr($path, strlen($p));
            } else {
                $imagePath = $project->image_name;
            }
            $project->update([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'start_date' => Carbon::parse($request->input('start_date')),
                'image_name' => $imagePath,
            ]);
            return redirect()->route('dashboard.projects')->with('success', 'Project bijgewerkt');
        } else {
            return redirect()->route('dashboard.projects')->with('error', 'Project kon niet worden bewerkt (niet gevonden)');
        }
    }
}
