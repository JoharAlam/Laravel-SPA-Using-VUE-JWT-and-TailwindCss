<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Data;
use App\MonthlySale;
use App\Sale;
use App\Purchase;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

// factory(\App\Data::class,21)->create() run in tinker

$factory->define(Data::class, function (Faker $faker) {
    return [
        "year"      =>  $faker->unique()->numberBetween(2000,2021),
        "name"          =>  'Garments',
        "price"         =>  $faker->numberBetween(50, 5000),
        "yearly_sale"         =>  $faker->numberBetween(50,500)
    ];
});

// factory(\App\MonthlySale::class,12)->create() run in tinker

$factory->define(MonthlySale::class, function (Faker $faker) {
    return [
        "name"          =>  'Garments',
        "year"      =>  '2021',
        "month"         =>  $faker->unique()->monthName(),
        "sale"         =>  $faker->numberBetween(5,100)
    ];
});

// factory(\App\Purchase::class,1)->create() run in tinker
$factory->define(Purchase::class, function (Faker $faker) {
    return [
        "retailer"          =>  $faker->company(),
        "product"      =>  'Shirt',
        "purchase_rate"         =>  '1399'
    ];
});

// factory(\App\Sale::class,25)->create() run in tinker
$factory->define(Sale::class, function (Faker $faker) {
    return [
        "buyer"          =>  $faker->company(),
        "product"      =>  'Shoes',
        "selling_rate"         =>  $faker->numberBetween(1001,1600)
    ];
});
