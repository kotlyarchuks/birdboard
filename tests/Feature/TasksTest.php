<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TasksTest extends TestCase
{
    use RefreshDatabase;

    /** @test * */
    function project_can_have_tasks()
    {
        $this->signIn();
        $project = factory('App\Project')->create(['owner_id' => auth()->user()->id]);

        $this->post($project->path() . '/tasks', ['text' => 'My new task']);
        $this->assertEquals('My new task', $project->tasks->first()->text);
    }

    /** @test * */
    function user_can_see_tasks_on_project_page()
    {
        $this->signIn();
        $project = factory('App\Project')->create(['owner_id' => auth()->user()->id]);
        $project->tasks()->createMany([
            $this->createTask($raw = true),
            $this->createTask($raw = true)
        ]);

        $this->get($project->path())
            ->assertSee($project->tasks->first()->text)
            ->assertSee($project->tasks->get(1)->text);
    }

    /** @test * */
    function you_cannot_add_tasks_to_project_you_do_not_own()
    {
        $this->signIn();

        $project = factory('App\Project')->create();
        $this->post($project->path() . '/tasks', ['text' => 'My new task'])
                ->assertStatus(403);
    }

    /** @test * */
    function task_requires_a_text()
    {
        $this->signIn();
        $project = factory('App\Project')->create(['owner_id' => auth()->user()->id]);

        $this->post($project->path() . '/tasks/', [])->assertSessionHasErrors('text');
    }

    /** @test * */
    function task_can_be_updated()
    {
        $this->signIn();
        $project = factory('App\Project')->create(['owner_id' => auth()->user()->id]);
        $task = $project->tasks()->create(['text' => 'Old task']);

        $this->patch($task->path(), [
            'text' => 'New task',
            'completed' => true
        ]);
        $this->assertEquals('New task', $project->tasks()->first()->text);
        $this->assertEquals(true, $project->tasks()->first()->completed);
    }

    /** @test * */
    function you_cannot_update_task_on_project_you_do_not_own()
    {
        $this->signIn();

        $project = factory('App\Project')->create();
        $task = $project->addTask('New task');
        $this->patch($task->path(), ['text' => 'Edited task'])
            ->assertStatus(403);
    }

    /** @test * */
    function updating_task_updates_project()
    {
        $this->signIn();

        $project1 = factory('App\Project')->create(['owner_id' => auth()->user()->id]);
        $project2 = factory('App\Project')->create(['owner_id' => auth()->user()->id]);

        $project1->addTask('New task');

        $this->get('/projects')->assertSeeInOrder([$project1->title, $project2->title]);
    }

    public function createTask($raw = false)
    {
        return $raw ? factory('App\Task')->raw() : factory('App\Task')->create();
    }
}
