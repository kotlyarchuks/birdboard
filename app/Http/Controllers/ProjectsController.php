<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function store(Request $request){
        $attributes = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'notes' => ''
        ]);

        $project = auth()->user()->projects()->create($attributes);

        return redirect($project->path());
    }

    public function index()
    {
        $projects = auth()->user()->projects()->orderBy('updated_at', 'desc')->get();

        return view('projects.index', compact('projects'));
    }

    public function show(Project $project)
    {
        if (auth()->user()->isNot($project->owner)) {
            abort(403);
        }

        return view('projects.show', compact('project'));
    }

    public function create()
    {
        return view('projects.create');
    }
}
