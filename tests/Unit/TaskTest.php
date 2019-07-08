<?php

namespace Tests\Unit;

use App\Project;
use App\User;
use Facades\Tests\Setup\ProjectFactory;
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

    /** @test * */
    function task_can_be_completed()
    {
        $task = factory('App\Task')->create();
        $task->complete();
        $this->assertTrue($task->fresh()->completed);
    }

    /** @test * */
    function task_can_be_marked_as_uncompleted()
    {
        $task = factory('App\Task')->create();
        $task->incomplete();
        $this->assertFalse($task->fresh()->completed);
    }
}
