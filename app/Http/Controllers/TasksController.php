<?php

namespace App\Http\Controllers;

use App\Project;
use App\Task;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function store(Project $project)
    {
        $this->authorize('update', $project);

        request()->validate(['text' => 'required']);
        $project->addTask(request('text'));

        return redirect($project->path());
    }

    public function update(Project $project, Task $task)
    {
        $this->authorize('update', $task->project);

        request()->validate(['text' => 'required']);

        $task->update(['text' => request('text')]);

        if(request()->has('completed')){
            $task->complete();
        }

        return redirect($project->path());
    }
}
