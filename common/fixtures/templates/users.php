<?php
/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */
return [
    'email' => $faker->unique()->email,
    'name' => $faker->firstName,
    'lastname' => $faker->lastName,
    'description' => $faker->text,
    'location' => $faker->address,
    'password' => Yii::$app->getSecurity()->generatePasswordHash('password_' . $index),
    'avatar' => $faker->imageUrl(65,65),
    'birth_date' => $faker->dateTimeBetween('1991-01-01', '2000-01-01')->format('Y-m-d'),
    'phone' => $faker->unique()->e164PhoneNumber,
    'social' => $faker->userName,
    'category_id' => '1,2',
    'show_contacts' => 1,
    'notification_email' => 1,
    'notification_action' => 1,
    'notification_review' => 1,
];

