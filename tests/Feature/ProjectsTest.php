<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectsTest extends TestCase {

    use WithFaker, RefreshDatabase;

    /** @test * */
    function should_be_authenticated_to_create_project()
    {
        $attributes = factory('App\Project')->raw();
        //Act
        $this->post('/projects', $attributes)->assertRedirect('login');
    }

    /** @test * */
    function user_can_create_project()
    {
        $this->signIn();

        $attributes = [
            'title'       => $this->faker->sentence,
            'description' => $this->faker->paragraph
        ];

        $this->post('/projects', $attributes)->assertRedirect('/projects');

        $this->assertDatabaseHas('projects', $attributes);

        $this->get('/projects')->assertSee($attributes['title']);
    }

    /** @test * */
    function user_can_view_project_page()
    {
        $this->signIn();
        $project = factory('App\Project')->create();

        $path = $project->path();

        $this->get($path)
            ->assertSee($project->title)
            ->assertSee($project->description);
    }

    /** @test * */
    function project_requires_a_title()
    {
        $this->signIn();
        $attributes = factory('App\Project')->raw(['title' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('title');
    }

    /** @test * */
    function project_requires_a_description()
    {
        $this->signIn();
        $attributes = factory('App\Project')->raw(['description' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('description');
    }

    public function signIn()
    {
        $this->actingAs(factory('App\User')->create());
    }
}
