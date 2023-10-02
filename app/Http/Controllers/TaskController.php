<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Project;
use App\Models\UserTask;
use App\Models\TaskState;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Requests\TaskStoreRequest;

class TaskController extends Controller
{
    public function create($project_id)
    {
        $states = TaskState::all();
        $project = Project::find($project_id);

        return view('projects.tasks.create', compact('states', 'project'));
    }

    public function edit($project_id, $taskid)
    {
        if ($task = Task::find($taskid)) {
            $states = TaskState::all();
            $users = User::all();
            $task = Task::find($taskid);

            return view('projects.tasks.edit', compact('states', 'users', 'task'));
        } else {
            return redirect()->route('dashboard.projects.tasks', [$task->project->id])->with('error', 'Taak kon niet worden gevonden');
        }
    }

    public function dashboard($project_id)
    {
        $tasks = Task::where('project_id', $project_id)->paginate(10);
        $projectid = $project_id;

        return view('projects.tasks.dashboard', compact('tasks', 'projectid'));
    }

    public function update(TaskStoreRequest $request, $project_id, $taskid)
    {
        if (($task = Task::find($taskid)) && $user_task = UserTask::where('task_id', '=', $taskid)) {
            $task->update([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'deadline' => Carbon::parse($request->input('start_date')),
                'state' => $request->input('state'),
            ]);

            $selectedUsers = $request->input('selected_users');

            foreach ($selectedUsers as $userId) {
                $user_task->update([
                    'user_id' => $userId,
                    'task_id' => $task->id,
                ]);
            }

            return redirect()->route('dashboard.projects.tasks', [$project_id])->with('success', 'Taak bijgewerkt');
        } else {
            return redirect()->route('dashboard.projects.tasks', [$project_id])->with('error', 'Taak kon niet worden bewerkt (niet gevonden)');
        }
    }

    public function store(TaskStoreRequest $request, $project_id)
    {
        try {
            $task = new Task();
            $task->title = $request->input('title');
            $task->description = $request->input('description');
            $task->deadline = Carbon::parse($request->input('deadline'));
            $task->state = $request->input('state');
            $task->project_id = $project_id;
            $task->save();

            $selectedUsers = $request->input('selected_users');

            foreach ($selectedUsers as $userId) {
                UserTask::create([
                    'user_id' => $userId,
                    'task_id' => $task->id,
                ]);
            }

            return redirect()->route('dashboard.projects.tasks', [$project_id])->with('success', 'Taak opgeslagen');
        } catch (\Exception $e) {
            return redirect()->route('dashboard.projects.tasks.create', [$project_id])
                ->withInput()
                ->with('error', 'Er is iets misgegaan' . $e);
        }
    }

    public function delete($id, $taskid)
    {
        if ($task = Task::find($taskid)) {
            $task->delete();
            return redirect()->route('dashboard.projects.tasks', [$id])->with('success', 'Taak verwijderd');
        } else {
            return redirect()->route('dashboard.projects.tasks', [$id])->with('error', 'Taak kon niet worden verwijderd (niet gevonden)');
        }
    }
}
