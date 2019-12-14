<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
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
        'identificacion' => '1065848333',
        'nombres' => 'CAMILO ANDRES',
        'apellidos' => 'COLON CAÑIZARES',
        'email' => 'colonca1999@gmail.com',
        'password' => \Illuminate\Support\Facades\Hash::make("1065848333"), // password
        'estado' => 'ACTIVO'
    ];
});
