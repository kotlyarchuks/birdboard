<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function store(Project $project)
    {
        $attributes = request()->validate([
            'text' => 'required'
        ]);
        $project->addTask($attributes['text']);

        return redirect($project->path());
    }

    public function create(Project $project)
    {
        return view('tasks.create', compact('project'));
    }
}
