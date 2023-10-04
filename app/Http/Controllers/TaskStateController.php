<?php

namespace App\Http\Controllers;

use App\Models\TaskState;
use App\Http\Requests\TaskStateStoreRequest;

class TaskStateController extends Controller
{
    public function create()
    {
        return view('states.create');
    }

    public function dashboard()
    {
        $states = TaskState::paginate(10);

        return view('states.dashboard', compact('states'));
    }

    public function store(TaskStateStoreRequest $request, TaskState $task_state)
    {
        $task_state->fill(([
            'name' => $request->input('name')

        ]));
        $task_state->save();

        return redirect()->route('dashboard.states')->with('success', 'Nieuwe status toegevoegd');
    }

    public function edit($id)
    {
        if ($state = TaskState::find($id)) {

            return view('states.edit', compact('state'));
        } else {
            return redirect()->route('dashboard.states')->with('error', 'Taak kon niet worden gevonden');
        }
    }

    public function delete($id)
    {
        if ($state = TaskState::find($id)) {
            $state->delete();
            return redirect()->route('dashboard.states', [$id])->with('success', 'Taak verwijderd');
        } else {
            return redirect()->route('dashboard.states', [$id])->with('error', 'Taak kon niet worden verwijderd (niet gevonden)');
        }
    }

    public function update(TaskStateStoreRequest $request, $id)
    {
        if (($state = TaskState::find($id))) {
            $state->update([
                'name' => $request->input('name'),
            ]);

            return redirect()->route('dashboard.states')->with('success', 'Status bijgewerkt');
        } else {
            return redirect()->route('dashboard.projects.tasks', [$id])->with('error', 'Taak kon niet worden bewerkt (niet gevonden)');
        }
    }
}
