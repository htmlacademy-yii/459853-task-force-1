<?php
// Подключаем autoload
require_once 'vendor/autoload.php';

use App\Controllers\AvailableActions;

// Test Vars
$task_id = 9;
$user_employee = 5;
$user_customer = 2;

// Нвоый экземпляр класса
$task = new AvailableActions($task_id, $user_employee, $user_customer, date('Y-m-d'), AvailableActions::STATUS_NEW);

if (isset(AvailableActions::getActions()[0])) {
    echo 'Статус: ' . $task->getNextStatus(AvailableActions::getActions()[0]) . '<br>';

    dump($task->getAvailableActions($user_customer));
    dump($task->getAvailableActions($user_employee));
}

if (isset(AvailableActions::getActions()[1])) {
    echo 'Статус: ' . $task->getNextStatus(AvailableActions::getActions()[1]) . '<br>';

    dump($task->getAvailableActions($user_customer));
    dump($task->getAvailableActions($user_employee));
}

if (isset(AvailableActions::getActions()[2])) {
    echo 'Статус: ' . $task->getNextStatus(AvailableActions::getActions()[2]) . '<br>';

    dump($task->getAvailableActions($user_customer));
    dump($task->getAvailableActions($user_employee));
}

if (isset(AvailableActions::getActions()[3])) {
    echo 'Статус: ' . $task->getNextStatus(AvailableActions::getActions()[3]) . '<br>';

    dump($task->getAvailableActions($user_customer));
    dump($task->getAvailableActions($user_employee));
}

if (isset(AvailableActions::getActions()[4])) {
    echo 'Статус: ' . $task->getNextStatus(AvailableActions::getActions()[4]) . '<br>';

    dump($task->getAvailableActions($user_customer));
    dump($task->getAvailableActions($user_employee));
}

if (isset(AvailableActions::getActions()[5])) {
    echo 'Статус: ' . $task->getNextStatus(AvailableActions::getActions()[5]) . '<br>';

    dump($task->getAvailableActions($user_customer));
    dump($task->getAvailableActions($user_employee));
}


// Проверка первого задания, возвращаем статусы

// Второе задание
// Передается id, в задании было что передается роль, но если id заказчика то он по умолчанию и автор объявления.
// Список действий для заказчика
//print_r($task->getAvailableActions($user_customer));
//echo '<br>';
//// Список действий для работника
//print_r($task->getAvailableActions($user_employee));

function dump($var) {
//    echo '<pre>';
        print_r($var);
//    echo '</pre>';
    echo '<br>';
}

