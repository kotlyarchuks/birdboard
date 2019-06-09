<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    /** @test * */
    function project_has_a_path()
    {
        $project = factory('App\Project')->create();

        $this->assertEquals("/projects/{$project->id}", $project->path());
    }

    /** @test * */
    function project_has_an_owner()
    {
        $project = factory('App\Project')->create();

        $this->assertInstanceOf(User::class, $project->owner);
    }
}
