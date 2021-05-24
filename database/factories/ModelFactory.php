<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Illuminate\Support\Str;

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
    static $password;
    static $id = 2;

    return [
//        'id' => $id++,
        'name'           => $faker->name,
        'email'          => $faker->safeEmail,
        'status'         => true,
        'confirm_code'   => Str::random(64),
        'password'       => $password ?: $password = bcrypt('secret'),
        'remember_token' => Str::random(10),
    ];
});

$factory->state(App\User::class, 'admin', function () use ($factory) {
    $user = $factory->raw(App\User::class);

    return array_merge($user, ['is_admin' => 1, 'password' => bcrypt('admin')]);
});

$factory->define(App\Category::class, function (Faker\Generator $faker) {
    static $id = 1;

    return [
//        'id' => $id++,
        'name'      => $faker->name,
        'parent_id' => 0,
        'path'      => $faker->url
    ];
});

$factory->define(App\Article::class, function (Faker\Generator $faker) {
    static $id = 1;
    $user_ids = \App\User::pluck('_id')->random();
    $category_ids = \App\Category::pluck('_id')->random();
    $title = $faker->sentence(mt_rand(3,10));
    return [
//        'id' => $id++,
        'user_id'      => $user_ids,
        'category_id'  => $category_ids,
        'last_user_id' => $user_ids,
        'slug'     => Str::slug($title),
        'title'    => $title,
        'subtitle' => strtolower($title),
        'content'  => $faker->paragraph,
        'page_image'       => $faker->imageUrl(),
        'meta_description' => $faker->sentence,
        'is_draft'         => false,
        'published_at'     => $faker->dateTimeBetween($startDate = '-2 months', $endDate = 'now')
    ];
});

$factory->define(App\Link::class, function (Faker\Generator $faker) {
    return [
        'name'  => $faker->name,
        'link'  => $faker->url,
        'image' => $faker->imageUrl()
    ];
});
