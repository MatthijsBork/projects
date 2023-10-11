<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use App\Models\UserTask;
use Illuminate\Http\Request;

class UserProjectsController extends Controller
{
    public function index()
    {
        $projects = auth()->user()->projects()->paginate(10);
        return view('projects.index', compact('projects'));
    }

    public function show(Project $project)
    {
        $this->authorize('hasProject', [Project::class, $project]);
        return view('projects.show', compact('project'));
    }

    public function showTasks(Project $project)
    {
        $project->load('userTasks');

        return view('projects.tasks.index', compact('project'));
    }

    public function showTask(Project $project, Task $task)
    {
        $this->authorize('hasTask', [Task::class, $task]);

        return view('projects.tasks.show', compact('task'));
    }
}
