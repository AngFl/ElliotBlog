<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'nickname' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'confirm_code' => str_random(35),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Detail::class, function (Faker\Generator $faker) {

    //$user_id = \App\User::lists('id')->toArray();



    return [
           //
            'user_id' => $faker->randomElement(range(1,3)),
            'title'   => $faker->sentence,
            'note'    => $faker->sentence,
            'author'  => 'elliots-Andsowe',

            'content' => $faker->paragraph,
    ];
});


$factory->define(App\Category::class, function (Faker\Generator $faker) {

    //$user_id = \App\User::lists('id')->toArray();

    return [
        //
        'detail_id' => $faker->randomElement(range(1,3)),
        'category'   => $faker->sentence,
        'tag'    => $faker->word,
    ];
});

$factory->define(App\Tag::class, function(Faker\Generator $faker){
    return [
        'describe' => $faker->word,
        //'note' => $faker->words
    ];
});


$factory->define(App\Comment::class, function (Faker\Generator $faker) {

    $user_id = \App\User::lists('id')->toArray();
    $detail_id = \App\Detail::lists('id')->toArray();

    return [
        //
        'body'        => $faker->paragraph,
        'user_id'     => $faker->randomElement($user_id),
        'detail_id'   => $faker->randomElement($detail_id)
    ];
});
