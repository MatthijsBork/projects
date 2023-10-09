<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Project;
use App\Models\ProjectUserRole;
use App\Http\Requests\ProjectUserRoleRequest;

class ProjectUserRoleController extends Controller
{
    public static function store(ProjectUserRoleRequest $request, $project_id)
    {
        $project_user_role = new ProjectUserRole();
        $project_user_role->project_id = $project_id;
        $project_user_role->user_id = $request->input('user_id');
        $project_user_role->role_id = $request->input('role_id');
        $project_user_role->save();

        return redirect()->route('dashboard.projects.roles', [$project_id])->with('success', 'Bijgewerkt');
    }

    public function edit($project_id)
    {
        $roles = Role::all();
        $users = User::all();
        $project = Project::where('id', $project_id)->first();
        $projectid = $project_id;
        $userroles = ProjectUserRole::where('project_id', '=', $project->id)->get();

        return view('projects.roles.roles', compact('projectid', 'users', 'project', 'roles', 'userroles'));
    }

    public function delete($id, $userrole_id)
    {
        if ($userrole = ProjectUserRole::find($userrole_id)) {
            $userrole->delete();
            return redirect()->route('dashboard.projects.roles', [$id])->with('success', 'Project bijgewerkt');
        } else {
            return redirect()->route('dashboard.projects.roles', [$id])->with('error', 'Gebruikersrol niet gevonden');
        }
    }
}
