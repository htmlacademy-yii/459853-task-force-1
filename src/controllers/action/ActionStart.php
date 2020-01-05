<?php


namespace App\Controllers\Action;

use App\Controllers\AvailableActions;

class ActionStart extends Action
{
    public static function getName()
    {
        return 'Начать';
    }

    public static function getCode()
    {
        return 'act_started';
    }

    public static function checkPermissions(int $initUser, AvailableActions $availableActions):bool
    {
        return $initUser === $availableActions->getEmployeeId() && $availableActions->getCurrentStatus() === AvailableActions::STATUS_NEW;
    }
}
