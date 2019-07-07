<?php

namespace Tests\Feature;

use App\User;
use Facades\Tests\Setup\ProjectFactory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InvitationsTest extends TestCase
{
    use RefreshDatabase;

    /** @test * */
    function project_can_invite_users()
    {
        $project = ProjectFactory::create();
        $project->invite($newUser = factory(User::class)->create());

        $this->actingAs($newUser)
            ->post(
                action('TasksController@store', $project),
                $task = ['text' => 'New Task']
            );

        $this->assertDatabaseHas('tasks', $task);
    }
}
