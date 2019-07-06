<?php

namespace Tests\Feature;

use App\Task;
use App\User;
use Facades\Tests\Setup\ProjectFactory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RecordsActivitiesTest extends TestCase
{
    use RefreshDatabase;

    /** @test * */
    function creating_project()
    {
        $project = ProjectFactory::create();
        
        $this->assertCount(1, $project->activities);
        $this->assertEquals('project_created', $project->activities[0]->description);
    }

    /** @test * */
    function updating_project()
    {
        $project = ProjectFactory::create();
        $originalTitle = $project->title;
        $project->update(['title' => 'changed']);

        $this->assertCount(2, $project->activities);
        $this->assertEquals('project_updated', $project->activities->last()->description);

        $expected = [
            'before' => [
                'title' => $originalTitle
            ],
            'after' => [
                'title' => 'changed'
            ]
        ];

        $this->assertEquals($expected, $project->activities->last()->changes);
    }

    /** @test * */
    function creating_task()
    {
        $this->withExceptionHandling();
        $project = ProjectFactory::withTasks(1)->create();

        $this->assertCount(2, $project->activities);

        $activity = $project->activities->last();
        $this->assertInstanceOf(Task::class, $activity->subject);
        $this->assertEquals($project->tasks->last()->text, $activity->subject->text);
        $this->assertEquals('task_created', $activity->description);
    }

    /** @test * */
    function completing_task()
    {
        $project = ProjectFactory::withTasks(1)->create();

        $project->tasks[0]->complete();

        $this->assertCount(3, $project->activities);

        $activity = $project->activities->last();
        $this->assertInstanceOf(Task::class, $activity->subject);
        $this->assertEquals($project->tasks->last()->text, $activity->subject->text);
        $this->assertEquals('task_completed', $activity->description);
    }

    /** @test * */
    function incompleting_task()
    {
        $project = ProjectFactory::withTasks(1)->create();

        $project->tasks[0]->complete();
        $project->tasks[0]->incomplete();

        $this->assertCount(4, $project->activities);
    }

    /** @test * */
    function deleting_task()
    {
        $project = ProjectFactory::withTasks(1)->create();

        $project->tasks[0]->delete();

        $this->assertCount(3, $project->activities);
    }

    /** @test * */
    function every_activity_records_author()
    {
        $user = factory(User::class)->create();

        $project = ProjectFactory::ownedBy($user)->create();
        $activity = $project->activities->last();
        $this->assertEquals($user->name, $activity->author->name);

        $project->tasks()->create(['text' => 'New task']);
        $activity = $project->fresh()->activities->last();
        $this->assertEquals($user->name, $activity->author->name);
    }
}
