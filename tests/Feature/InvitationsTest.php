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
        $this->withoutExceptionHandling();
        $owner = factory(User::class)->create();
        $user = factory(User::class)->create();
        $project = ProjectFactory::ownedBy($owner)->create();

        $this->actingAs($owner)->post($project->path().'/invitations', [
            'email' => $user->email,
        ])->assertRedirect($project->path());

        $this->assertTrue($project->members->contains($user));
    }

    /** @test * */
    function not_owner_cant_invite_users()
    {
        $notOwner = factory(User::class)->create();
        $user = factory(User::class)->create();

        $project = ProjectFactory::create();

        $this->actingAs($notOwner)->post($project->path().'/invitations', [
            'email' => $user->email,
        ])->assertStatus(403);
    }

    /** @test * */
    function invited_email_should_be_associated_with_valid_account()
    {
        $owner = factory(User::class)->create();
        $project = ProjectFactory::ownedBy($owner)->create();

        $this->actingAs($owner)->post($project->path().'/invitations', [
            'email' => 'notavalid@example.com',
        ])->assertSessionHasErrors(['email' => 'Email should be valid']);
    }

    /** @test * */
    function invited_user_can_update_project()
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
