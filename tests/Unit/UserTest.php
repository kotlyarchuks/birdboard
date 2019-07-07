<?php

namespace Tests\Unit;

use App\User;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test * */
    function has_projects()
    {
        //Arrange
        $user = factory('App\User')->create();
        //Act
        $this->assertInstanceOf(Collection::class, $user->projects);
    }

    /** @test * */
    function has_accessible_projects()
    {
        $john = factory(User::class)->create();
        $mary = factory(User::class)->create();
        $nick = factory(User::class)->create();

        $johnProject = ProjectFactory::ownedBy($john)->create();
        $maryProject = ProjectFactory::ownedBy($mary)->create();

        $johnProject->invite($mary);

        $this->assertCount(0, $nick->accessibleProjects());

        $maryProjects = $mary->accessibleProjects();
        $this->assertTrue($maryProjects->contains($johnProject));
        $this->assertTrue($maryProjects->contains($maryProject));
        $this->assertCount(2,$maryProjects);
    }
}
