<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Task;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'text' => $faker->sentence,
        'project_id' => function(){
            return factory(App\Project::class)->create()->id;
        }
    ];
});
