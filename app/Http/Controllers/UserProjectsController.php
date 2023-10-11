<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class UserProjectsController extends Controller
{
    public function dashboard()
    {
        $projects = auth()->user()->projects()->paginate(10);
        return view('projects.user.dashboard', compact('projects'));
    }

    public function show(Project $project)
    {
        $this->authorize('hasProject', [Project::class, $project]);
        return view('projects.show', compact('project'));
    }

    public function showTasks(Project $project)
    {
        $this->authorize('viewTasksInProject', $project);

        $tasks = $project->tasks;

        return view('tasks.index', compact('tasks'));
    }
}
