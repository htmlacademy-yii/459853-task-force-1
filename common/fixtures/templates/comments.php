<?php
/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */
return [
    'task_id' => $faker->numberBetween(1, 10),
    'user_create_id' => $faker->numberBetween(1, 10),
    'user_employee_id' => $faker->numberBetween(1, 10),
    'description' => $faker->text(150),
    'rating' => $faker->numberBetween(1, 5),
];

