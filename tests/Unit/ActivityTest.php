<?php

namespace Tests\Unit;

use App\User;
use Facades\Tests\Setup\ProjectFactory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ActivityTest extends TestCase
{
    use RefreshDatabase;

    /** @test * */
    function it_has_an_author()
    {
        $user = factory(User::class)->create();

        $project = ProjectFactory::ownedBy($user)->create();

        $activity = $project->activities->last();
        $this->assertInstanceOf(User::class, $activity->author);
        $this->assertEquals($user->id, $activity->author->id);
    }
}
