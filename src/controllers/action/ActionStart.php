<?php


namespace App\controllers\action;

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

    // check permissions
    public static function checkPermissions(int $init_user, AvailableActions $availableActions)
    {
        return $init_user === $availableActions->getEmploeeId() && $availableActions->getCurrentStatus() === AvailableActions::STATUS_NEW;
    }
}
