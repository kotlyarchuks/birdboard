<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectsTest extends TestCase {

    use WithFaker, RefreshDatabase;

    /** @test * */
    function user_can_create_project()
    {
        $this->withoutExceptionHandling();

        $attributes = [
            'title'       => $this->faker->sentence,
            'description' => $this->faker->paragraph
        ];

        $this->post('/projects', $attributes);

        $this->assertDatabaseHas('projects', $attributes);
    }
}
