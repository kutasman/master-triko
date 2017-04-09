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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(\App\Models\Product::class, function (){
	return [
		'title' => 'Test Title',
		'price' => 123,
		'factory_id' => 1,
	];
});

$factory->define(\App\Models\Modificator::class, function (Faker\Generator $faker){

	return [
		'name' => $faker->name,
		'type' => 'select',
	];
});

$factory->define(\App\Models\ModOption::class, function (Faker\Generator $faker){

	return [
		'name' => $faker->title,
		'rise' => $faker->numberBetween(20,300),
	];
});

$factory->define(\App\Models\Cart::class, function (Faker\Generator $faker){
	return [
		'session' => 'asdasgdhfgaksdhgfkajhgdskfhasdk'
	];
});