<?php

namespace Tests\Unit;

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
}
