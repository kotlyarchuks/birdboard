<?php

namespace Tests\Feature;

use Facades\Tests\Setup\ProjectFactory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TasksTest extends TestCase
{
    use RefreshDatabase;

    /** @test * */
    function project_can_have_tasks()
    {
        $project = ProjectFactory::create();

        $this->actingAs($project->owner)
            ->post($project->path() . '/tasks', $attributes = ['text' => 'My new task']);

        $this->assertDatabaseHas('tasks', $attributes);
        $this->get($project->path())
            ->assertSee($attributes['text']);
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
        $project = ProjectFactory::create();

        $this->actingAs($project->owner)
            ->post($project->path() . '/tasks/', [])
            ->assertSessionHasErrors('text');
    }

    /** @test * */
    function task_can_be_updated()
    {
        $project = ProjectFactory::withTasks(1)->create();

        $this->actingAs($project->owner)
            ->patch($project->tasks->first()->path(), $attributes = [
            'text' => 'New task',
        ]);

        $this->assertDatabaseHas('tasks', $attributes);
    }

    /** @test * */
    function task_can_be_completed()
    {
        $project = ProjectFactory::withTasks(1)->create();

        $this->actingAs($project->owner)
            ->patch($project->tasks->first()->path(), $attributes = [
                'text' => 'New text',
                'completed' => true
            ]);

        $this->assertTrue($project->tasks->first()->fresh()->completed);
    }

    /** @test * */
    function task_can_be_marked_as_uncompleted()
    {
        $project = ProjectFactory::withTasks(1)->create();

        $this->actingAs($project->owner)
            ->patch($project->tasks->first()->path(), $attributes = [
                'text' => 'New text',
                'completed' => true
            ]);

        $this->patch($project->tasks->first()->path(), $attributes = [
                'text' => 'New text',
                'completed' => false
            ]);

        $this->assertFalse($project->tasks->first()->fresh()->completed);
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
