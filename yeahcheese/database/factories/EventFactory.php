<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Event;
use App\User;

$factory->define(Event::class, function () {
    return [
        'name' => 'party',
        'start_at' => '2019-10-10',
        'end_at' => '2020-04-01',
        'authorization_key' => '11111111',
        'user_id' => factory(User::class)->create()->id,
    ];
});
