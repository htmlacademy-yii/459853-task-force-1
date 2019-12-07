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

    // check permissions
    public static function checkPermissions(int $init_user, AvailableActions $availableActions)
    {
        return $init_user === $availableActions->getEmployeeId() && $availableActions->getCurrentStatus() === AvailableActions::STATUS_STARTED;
    }
}
