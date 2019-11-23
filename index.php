<?php
// Подключаем autoload
require_once 'vendor/autoload.php';

use App\Controllers\AvailableActions;

// Test Vars
$task_id = 9;
$user_employee = 5;
$user_customer = 2;

// Нвоый экземпляр класса
$task = new AvailableActions($task_id, $user_employee, $user_customer, date('Y-m-d'), AvailableActions::ACTION_CREATE);

// Проверка первого задания, возвращаем статусы
//echo '<pre>';
//var_dump($task->getNextStatus($task::ACTION_CREATE));
//var_dump($task->getNextStatus($task::ACTION_START));
//var_dump($task->getNextStatus($task::ACTION_APPROVE));
//var_dump($task->getNextStatus($task::ACTION_CANCEL));
//var_dump($task->getNextStatus($task::ACTION_FAILED));
//echo '</pre>';

// Второе задание
// Передается id, в задании было что передается роль, но если id заказчика то он по умолчанию и автор объявления.
// Список действий для заказчика
print_r($task->getAvailableActions($user_customer));
// Список действий для работника
print_r($task->getAvailableActions($user_employee));

