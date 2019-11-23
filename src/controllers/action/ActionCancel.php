<?php

namespace App\Controllers\Action;

use App\Controllers\AvailableActions;

class ActionCancel extends Action
{
    public static function getName()
    {
        return 'Отказаться';
    }

    public static function getCode()
    {
        return 'cancel';
    }

    // check permissions
    public static function checkPermissions(int $init_user, AvailableActions $availableActions)
    {
        return $init_user === $availableActions->getEmploeeId();
    }
}
