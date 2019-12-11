<?php


namespace App\Controllers\Action;

use App\Controllers\AvailableActions;

class ActionApprove extends Action
{
    public static function getName()
    {
        return 'Принять (Завершить)';
    }

    public static function getCode()
    {
        return 'act_approve';
    }

    public static function checkPermissions(int $initUser, AvailableActions $availableActions):bool
    {
        return $initUser !== $availableActions->getEmployeeId() && $availableActions->getCurrentStatus() === AvailableActions::STATUS_STARTED;
    }
}
