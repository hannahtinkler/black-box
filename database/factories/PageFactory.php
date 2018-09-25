<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\Page::class, function (Faker $faker) {
    return [
        'chapter_id' => function () {
            return factory(App\Models\Chapter::class)->create()->id;
        },
        'title' => $faker->title,
        'description' => $faker->paragraph,
        'content' => $faker->paragraph,
        'has_resources' => $faker->boolean,
        'created_by' => function () {
            return factory(App\Models\User::class)->create()->id;
        },
    ];
});
