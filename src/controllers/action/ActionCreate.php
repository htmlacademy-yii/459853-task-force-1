<?php

namespace App\Controllers\Action;

use App\Controllers\AvailableActions;

class ActionCreate extends Action
{
    public static function getName()
    {
        return 'Создать';
    }

    public static function getCode()
    {
        return 'create';
    }

    // check permissions
    public static function checkPermissions(int $init_user, AvailableActions $availableActions)
    {
        return $init_user !== $availableActions->getEmploeeId();
    }
}
