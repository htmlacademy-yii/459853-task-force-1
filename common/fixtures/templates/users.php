<?php
/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */
return [
    'name' => $faker->name,
    'email' => $faker->email,
    'lastname' => $faker->url,
    'location' => $faker->address,
    'phone' => substr($faker->e164PhoneNumber, 1, 11)
];