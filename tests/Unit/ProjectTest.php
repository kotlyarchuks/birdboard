<?php

namespace Tests\Unit;

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
        //Arrange
        $project = factory('App\Project')->create();
        //Act
        $this->assertEquals("/projects/{$project->id}", $project->path());
    }
}
