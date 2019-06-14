<?php

namespace Tests\Feature;

use App\Project;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Str;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectsTest extends TestCase {

    use WithFaker, RefreshDatabase;

    /** @test * */
    function guests_cannot_create_project()
    {
        $attributes = factory('App\Project')->raw();

        $this->post('/projects', $attributes)->assertRedirect('login');
    }

    /** @test * */
    function guests_cannot_view_list_of_projects()
    {
        factory('App\Project', 2)->create();

        $this->get('/projects')->assertRedirect('login');
    }

    /** @test * */
    function guests_cannot_view_single_project()
    {
        $project = factory('App\Project')->create();

        $this->get($project->path())->assertRedirect('login');
    }

    /** @test * */
    function guests_cannot_visit_create_project_page()
    {
        $this->get('/projects/create')->assertRedirect('login');
    }

    /** @test * */
    function user_can_create_project()
    {
        $this->signIn();

        $attributes = [
            'title'       => $this->faker->sentence,
            'description' => $this->faker->paragraph
        ];

        $this->post('/projects', $attributes)->assertRedirect('/projects/1');

        $this->assertDatabaseHas('projects', $attributes);

        $this->get('/projects')->assertSee($attributes['title']);
    }

    /** @test * */
    function user_can_view_own_project_page()
    {
        $this->signIn();
        $project = factory('App\Project')->create(['owner_id' => auth()->user()->id]);

        $this->get($project->path())
            ->assertSee($project->title)
            ->assertSee(Str::limit($project->description, 100));
    }

    /** @test * */
    function user_cannot_view_projects_of_others()
    {
        $this->signIn();

        $project = factory('App\Project')->create();

        $this->get($project->path())
            ->assertStatus(403);
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

    /** @test * */
    function most_recent_projects_are_shown_first()
    {
        $this->signIn();

        $project1 = factory('App\Project')->create(['owner_id' => auth()->user()->id]);
        $project2 = factory('App\Project')->create(['owner_id' => auth()->user()->id, 'title' => 'Latest title']);
        $project1->update(['title' => 'Updated title']);
        $this->get('/projects')->assertSeeInOrder(['Updated title', 'Latest title']);
    }
}
