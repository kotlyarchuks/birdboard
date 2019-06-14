<?php

namespace Tests\Unit;

use App\Project;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    /** @test * */
    function task_has_path()
    {
        $task = factory('App\Task')->create();

        $this->assertEquals($task->project->path() . '/tasks/' . $task->id, $task->path());
    }

    /** @test * */
    function task_belongs_to_project()
    {
        $task = factory('App\Task')->create();

        $this->assertInstanceOf(Project::class, $task->project);
    }
}
