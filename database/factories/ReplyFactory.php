<?php

/** @var Factory $factory */

use App\Reply;
use App\User;
use App\Thread;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Reply::class, function (Faker $faker) {
    return [
        'body' => $faker->paragraph,
        'thread_id' => factory(Thread::class),
        'user_id' => factory(User::class),
    ];
});
