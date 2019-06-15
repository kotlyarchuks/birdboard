<?php

namespace App\Http\Controllers;

use App\Project;
use App\Task;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function store(Project $project)
    {
        if (auth()->user()->isNot($project->owner)) {
            abort(403);
        }

        request()->validate(['text' => 'required']);
        $project->addTask(request('text'));

        return redirect($project->path());
    }

    public function update(Project $project, Task $task)
    {
        if (auth()->user()->isNot($task->project->owner)) {
            abort(403);
        }

        request()->validate(['text' => 'required']);

        $task->update([
            'text' => request('text'),
            'completed' => request()->has('completed')
        ]);

        return redirect($project->path());
    }
}