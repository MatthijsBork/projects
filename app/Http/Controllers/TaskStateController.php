<?php

namespace App\Http\Controllers;

use App\Models\TaskState;
use App\Http\Requests\TaskStateStoreRequest;

class TaskStateController extends Controller
{
    public function dashboard()
    {
        $states = TaskState::paginate(10);

        return view('states.dashboard', compact('states'));
    }

    public function create()
    {
        return view('states.create');
    }

    public function edit(TaskState $state)
    {
        return view('states.edit', compact('state'));
    }

    public function store(TaskStateStoreRequest $request)
    {
        $task_state = new TaskState();
        $task_state->name = $request->input('name');
        $task_state->save();

        return redirect()->route('dashboard.states')->with('success', 'Nieuwe status toegevoegd');
    }

    public function update(TaskStateStoreRequest $request, TaskState $state)
    {
        $state->update([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('dashboard.states')->with('success', 'Status bijgewerkt');
    }

    public function delete(TaskState $state)
    {
        $state->delete();
        return redirect()->route('dashboard.states', [$state])->with('success', 'Taak verwijderd');
    }
}
