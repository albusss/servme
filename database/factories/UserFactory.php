<?php
/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\User;
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

$factory->define(User::class, function (Faker $faker) {
    return [
        'email' => $faker->email,
        'firstname' => $faker->name,
        'lastname' => $faker->name,
        'mobileNumber' => $faker->phoneNumber,
        'gender' => $faker->word,
        'birthday' => $faker->dateTime,
        'createdAt' => $faker->dateTime,
        'password' => $faker->password,
        'apiKey' => \base64_encode($faker->word),
    ];
});
