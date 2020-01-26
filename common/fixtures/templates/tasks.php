<?php
/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */
return [
    'title' => $faker->sentence(5, true),
    'description' => $faker->text(300),
    'category_id' => $faker->numberBetween(1, 8),
    'attachment' => 'Attachment',
    'location' => $faker->address,
    'price' => $faker->numberBetween(100, 9999),
    'end_date' => $faker->dateTimeBetween('+ 1 day', '+ 30 days')->format('Y-m-d'),
    'user_create_id' => $faker->numberBetween(1, 10),
    'user_employee_id' => '',
    'status_id' => $faker->numberBetween(1, 3)
];

