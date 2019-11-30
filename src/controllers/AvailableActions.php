<?php

namespace App\Controllers;

use App\Controllers\Action\ActionApprove;
use App\Controllers\Action\ActionCancel;
use App\Controllers\Action\ActionCreate;
use App\Controllers\Action\ActionFailed;
use App\Controllers\Action\ActionStart;

class AvailableActions
{
    // STATUSES
    const STATUS_NEW = 'new';
    const STATUS_STARTED = 'started';
    const STATUS_DONE = 'done';
    const STATUS_CANCEL = 'canceled';
    const STATUS_FAIL = 'failed';
    // ROLES
    const ROLE_CUSTOMER = 'customer';
    const ROLE_EMPLOYEE = 'employee';

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

    public static function getStatuses()
    {
        return [
            self::STATUS_NEW,
            self::STATUS_STARTED,
            self::STATUS_DONE,
            self::STATUS_CANCEL,
            self::STATUS_FAIL
        ];
    }

    public static function getActions()
    {
        return [
            ActionCreate::class,
            ActionStart::class,
            ActionApprove::class,
            ActionCancel::class,
            ActionFailed::class
        ];
    }

    public function getEmploeeId()
    {
        return $this->employee_id;
    }

    public function getCustomerId()
    {
        return $this->customer_id;
    }

    public function getCurrentStatus()
    {
        return $this->current_status;
    }

    /**
     * Возращает статус для переданного действия
     * @param $action | передается в виде ActionCreate::class
     * @return string
     */
    public function getNextStatus($action)
    {
        $statuses = $this->getStatuses();
        return $this->current_status = $statuses[array_search($action, $this->getActions())];
    }

    /**
     * Возвращает список доступных действий для пользователя
     * @param int $init_user | id user который передаем
     * @return array | Список действий
     */
    public function getAvailableActions(int $init_user)
    {
        $actions = [];

        foreach ($this->getActions() as $action) {
            if ($action::checkPermissions($init_user, $this)) {
                $actions[] = $action::getCode();
            }
        }

        return $actions;
    }
}
