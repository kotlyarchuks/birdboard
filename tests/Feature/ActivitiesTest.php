<?php

namespace Tests\Feature;

use Facades\Tests\Setup\ProjectFactory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ActivitiesTest extends TestCase
{
    use RefreshDatabase;

    /** @test * */
    function creating_project_records_activity()
    {
        $project = ProjectFactory::create();
        
        $this->assertCount(1, $project->activities);
        $this->assertEquals('created', $project->activities[0]->description);
    }

    /** @test * */
    function updating_project_records_activity()
    {
        $project = ProjectFactory::create();
        $project->update(['title' => 'changed']);

        $this->assertCount(2, $project->activities);
        $this->assertEquals('updated', $project->activities->last()->description);
    }

    /** @test * */
    function creating_task_records_activity()
    {
        $project = ProjectFactory::withTasks(1)->create();

        $this->assertCount(2, $project->activities);
        $this->assertEquals('task_created', $project->activities->last()->description);
    }

    /** @test * */
    function completing_task_records_activity_for_project()
    {
        $project = ProjectFactory::withTasks(1)->create();

        $project->tasks[0]->complete();

        $this->assertCount(3, $project->activities);
    }
}
