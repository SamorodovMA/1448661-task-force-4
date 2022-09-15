<?php
/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */
return [
    'name' => $faker->name,
    'email' => $faker->email,
    'phone' => substr($faker->e164PhoneNumber, 1, 11),
    'password' => $faker->password
];
