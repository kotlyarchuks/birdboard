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

        $task->update(request()->validate(['text' => 'required']));

        $method = request('completed') ? 'complete' : 'incomplete';
        $task->$method();

        return redirect($project->path());
    }
}
