<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TasksTest extends TestCase
{
    use RefreshDatabase;

    /** @test * */
    function user_can_see_tasks_on_project_page()
    {
        $this->signIn();
        $project = factory('App\Project')->create();
        $project->tasks()->createMany([
            $this->createTask($raw = true),
            $this->createTask($raw = true)
        ]);

        $this->get($project->path())
            ->assertSee($project->tasks->first()->text)
            ->assertSee($project->tasks->get(1)->text);
    }

    public function signIn()
    {
        $this->actingAs(factory('App\User')->create());
    }

    public function createTask($raw = false)
    {
        return $raw ? factory('App\Task')->raw() : factory('App\Task')->create();
    }
}
