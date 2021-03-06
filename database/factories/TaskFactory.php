<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Task;
use App\User;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    return [
        //
        'title' => $faker->sentence,
        'description' => $faker->paragraph,
        'due_at' => null,
        'is_completed' => false,
        'user_id' => function(){
            return factory(User::class)->create()->id;
        }
    ];
});

$factory->state(Task::class, 'completed', function( Faker $faker){
    return [
        'is_completed' => true
    ];
});

