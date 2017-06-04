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

$factory->define(\App\Models\Factory::class, function(Faker\Generator $faker){
	return [
		'name' => $faker->sentence(1),
		'slug' => snake_case($faker->name),
	];
});

$factory->define(\App\Models\Category::class, function (Faker\Generator $faker){
	return [
		'name' => $faker->sentence(1),
		'description' => $faker->sentence('6'),

	];
});

$factory->define(\App\Models\Product::class, function (Faker\Generator $faker){
	return [
		'title' => $faker->sentence(2),
		'price' => $faker->randomFloat(2, 100, 1000),
		'factory_id' => 1,
        'active' => true,
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
        'modificator_id' => factory(\App\Models\Modificator::class)->create()->id,
        'default' => 0,
	];
});

$factory->define(\App\Models\Cart::class, function (Faker\Generator $faker){
	return [
		'session' => 'asdasgdhfgaksdhgfkajhgdskfhasdk'
	];
});

$factory->define(\App\Models\ShippingType::class, function (){

	return [
		'name' => 'Poshta',
		'description' => 'test',
		'slug' => 'pushta',
		'meta' => [
			'apiKey' => 'vhdkjfhvkjhrlgjhdfkjlgkljfh',
		],
	];
});

$factory->define(\App\Models\Shipping::class, function(Faker\Generator $faker){

	return [
		'type_id' => 1,
		'order_id' => 1,
		'meta' => [
			'first_name' => $faker->firstName,
			'last_name' => $faker->lastName,
			'address' => $faker->address,
		]
	];
});

$factory->define(\App\Models\Order::class, function (Faker\Generator $faker){

	return $data = [
		'cart_id' => factory(\App\Models\Cart::class)->create()->id,
		'first_name' => $faker->firstName,
		'last_name' => $faker->lastName,
		'email' => $faker->email,
		'phone' => $faker->phoneNumber,
		'comment' => $faker->sentence(),
	];

});

$factory->define(\App\Models\OrderStatus::class, function(){
	return [
		'name' => 'New',
		'description' => 'New Order',
		'slug' => 'new',
	];
});

$factory->define(\App\Models\ModRule::class, function(){

    $toggle = factory(\App\Models\Modificator::class)->create();

    return [
        'product_id' => factory(\App\Models\Product::class)->create()->id,
        'target_id' => factory(\App\Models\Modificator::class)->create()->id,
        'toggle_id' => $toggle->id,
        'toggle_option_id' => factory(\App\Models\ModOption::class)->create(['modificator_id' => $toggle->id]),
        'action' => 'disable',
    ];
});