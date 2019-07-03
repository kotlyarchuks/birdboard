<?php

namespace Tests\Feature;

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
        $this->assertEquals('created', $project->activities[0]->description);
    }

    /** @test * */
    function updating_project()
    {
        $project = ProjectFactory::create();
        $project->update(['title' => 'changed']);

        $this->assertCount(2, $project->activities);
        $this->assertEquals('updated', $project->activities->last()->description);
    }

    /** @test * */
    function creating_task()
    {
        $project = ProjectFactory::withTasks(1)->create();

        $this->assertCount(2, $project->activities);
        $this->assertEquals('task_created', $project->activities->last()->description);
    }

    /** @test * */
    function completing_task()
    {
        $project = ProjectFactory::withTasks(1)->create();

        $project->tasks[0]->complete();

        $this->assertCount(3, $project->activities);
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
}
