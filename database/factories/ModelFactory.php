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
	static $password;

	return [
		'name' => $faker->name,
		'email' => $faker->safeEmail,
		'password' => $password ? : $password = bcrypt('secret'),
		'remember_token' => str_random(10),
	];
});

$factory->define(App\Post::class, function (Faker\Generator $faker) {

	return [
		'title' => $faker->sentence(2),
		'slug' => $faker->slug,
		'content' => $faker->text(50),
		'author_id'=>'1',
		'category_id'=>'1'
	];
});
$factory->define(App\Category::class, function (Faker\Generator $faker) {

	return [
		'name' => $faker->word,
		'slug' => $faker->slug,
	];
});