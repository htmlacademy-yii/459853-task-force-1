<?php
declare(strict_types=1);
namespace App\Controllers;

use App\Controllers\Action\ActionApprove;
use App\Controllers\Action\ActionCancel;
use App\Controllers\Action\ActionFailed;
use App\Controllers\Action\ActionRefuse;
use App\Controllers\Action\ActionStart;
use App\Exception\ActionException;

class AvailableActions
{
    // STATUSES
    const STATUS_NEW = 'new';
    const STATUS_STARTED = 'started';
    const STATUS_DONE = 'done';
    const STATUS_CANCEL = 'canceled';
    const STATUS_FAIL = 'failed';
    const STATUS_REFUSE = 'refuse';
    // ROLES
    const ROLE_CUSTOMER = 'customer';
    const ROLE_EMPLOYEE = 'employee';

    private $task_id = 0;
    private $employee_id;
    private $customer_id;
    private $end_date;
    private $current_status;

    public function __construct(int $task_id, int $employee_id, int $customer_id, string $end_date, string $current_status)
    {
        $this->task_id = $task_id;
        $this->employee_id = $employee_id;
        $this->customer_id = $customer_id;
        $this->end_date = $end_date;
        $this->current_status = $current_status;

        if(!in_array($current_status, $this->getStatuses())) {
            throw new ActionException('Конструктор, статуса не существует');
        }
    }

    public static function getStatuses():array
    {
        return [
            self::STATUS_NEW,
            self::STATUS_STARTED,
            self::STATUS_DONE,
            self::STATUS_CANCEL,
            self::STATUS_FAIL,
            self::STATUS_REFUSE
        ];
    }

    public static function getActions():array
    {
        return [
            ActionStart::class,
            ActionApprove::class,
            ActionCancel::class,
            ActionFailed::class,
            ActionRefuse::class
        ];
    }

    public function getEmployeeId():int
    {
        return $this->employee_id;
    }

    public function getCustomerId():int
    {
        return $this->customer_id;
    }

    public function getCurrentStatus():string
    {
        return $this->current_status;
    }

    /**
     * Возращает статус для переданного действия
     * @param $action | передается в виде ActionCreate::class
     * @return string
     * @throws ActionException
     */
    public function getNextStatus(string $action):string
    {
        $statuses = $this->getStatuses();
        $find_item = array_search($action, $this->getActions());

        if (!in_array($action, $this->getActions())) {
            throw new ActionException('Статус для действия не найден');
        }

        return $this->current_status = $statuses[$find_item];
    }

    /**
     * Возвращает список доступных действий для пользователя
     * @param int $init_user | id user который передаем
     * @return array | список действий
     * @throws ActionException
     */
    public function getAvailableActions(int $init_user):array
    {

        if($this->getCustomerId() !== $init_user && $this->getEmployeeId() !== $init_user) {
            throw new ActionException('Роль пользователя не определена');
        }

        $actions = [];
        foreach ($this->getActions() as $action) {

            if (!$init_user) {
                throw new ActionException('Трабл');
            }

            if ($action::checkPermissions($init_user, $this)) {
                $actions[] = $action::getCode();
            }
        }

        return $actions;
    }
}
