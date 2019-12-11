<?php

namespace App\Controllers\Action;

use App\Controllers\AvailableActions;

class ActionFailed extends Action
{
    public static function getName()
    {
        return 'Провалено';
    }

    public static function getCode()
    {
        return 'act_failed';
    }

    public static function checkPermissions(int $initUser, AvailableActions $availableActions):bool
    {
        return $initUser === $availableActions->getCustomerId() && $availableActions->getCurrentStatus() === AvailableActions::STATUS_STARTED;
    }
}
