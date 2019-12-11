<?php


namespace App\Controllers\Action;

use App\Controllers\AvailableActions;

class ActionRefuse extends Action
{
    public static function getName()
    {
        return 'Отказаться';
    }

    public static function getCode()
    {
        return 'act_refuse';
    }

    public static function checkPermissions(int $initUser, AvailableActions $availableActions):bool
    {
        return $initUser === $availableActions->getEmployeeId() && $availableActions->getCurrentStatus() === AvailableActions::STATUS_STARTED;
    }
}
