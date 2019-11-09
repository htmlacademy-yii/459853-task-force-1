<?php
    require_once 'php/OrderCycle.php';

    $task = new OrderCycle(5, 2, 2, date("Y-m-d"), 'create');
    echo '<pre>';
    var_dump($task->getNextStatus($task::ACTIONS[0]));
    var_dump($task->getNextStatus($task::ACTIONS[1]));
    var_dump($task->getNextStatus($task::ACTIONS[2]));
    var_dump($task->getNextStatus($task::ACTIONS[3]));
    var_dump($task->getNextStatus($task::ACTIONS[4]));
    echo '</pre>';
