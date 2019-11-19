<?php

namespace App\Controllers;

class OrderCycle
{
    // Actions
    const ACTIONS = [
        'ActionCreate',
        'ActionStart',
        'ActionApprove',
        'ActionCancel',
        'ActionFailed'
    ];
    // Statuses
    const STATUSES = [
        'new',
        'started',
        'done',
        'canceled',
        'failed'
    ];
    // ROLES
    const ROLES = [
        'customer',
        'employee'
    ];

    private $task_id = 0;
    private $employee_id;
    private $customer_id;
    private $end_date;
    private $current_status;

    public function __construct($task_id, $employee_id, $customer_id, $end_date, $current_status)
    {
        $this->task_id = $task_id;
        $this->employee_id = $employee_id;
        $this->customer_id = $customer_id;
        $this->end_date = $end_date;
        $this->current_status = $current_status;
    }

    public function getStatuses()
    {
        return self::STATUSES;
    }

    public function getActions()
    {
        return self::ACTIONS;
    }

    public function getNextStatus($action)
    {
        // а если индексы будут разные?
        return $this->current_status = self::STATUSES[array_search($action, self::ACTIONS)];
    }
}
