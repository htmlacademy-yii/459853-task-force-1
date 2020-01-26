<?php
/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */
return [
    'name' => $faker->sentence(1,true),
    'code' => $faker->unique()->randomElement([
        'translation',
        'clean',
        'cargo',
        'neo',
        'flat',
        'repair',
        'beauty',
        'photo'
    ]),
];

