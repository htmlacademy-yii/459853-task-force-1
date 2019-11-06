<?php
    require_once 'php/OrderCycle.php';

    $task = new OrderCycle(5, 2, 2, date("Y-m-d"), 'create');
    echo '<pre>';
    var_dump($task->getNextStatus('create'));
    var_dump($task->getNextStatus('start'));
    var_dump($task->getNextStatus('approve'));
    var_dump($task->getNextStatus('cancel'));
    var_dump($task->getNextStatus('degree'));
    echo '</pre>';
