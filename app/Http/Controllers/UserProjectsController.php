<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserProjectsController extends Controller
{
    public function dashboard()
    {
        $projects = auth()->user()->projects()->paginate(10);
        return view('projects.user.dashboard', compact('projects'));
    }
}
