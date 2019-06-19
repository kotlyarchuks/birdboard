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
    function creating_project_generates_activity()
    {
        $project = ProjectFactory::create();

        $this->assertCount(1, $project->activities);
        $this->assertEquals('created', $project->activities[0]->description);
    }

    /** @test * */
    function updating_project_generates_activity()
    {
        $project = ProjectFactory::create();
        $project->update(['title' => 'changed']);

        $this->assertCount(2, $project->activities);
        $this->assertEquals('updated', $project->activities->last()->description);
    }
}
