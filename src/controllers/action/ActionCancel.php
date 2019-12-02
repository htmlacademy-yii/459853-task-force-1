<?php

namespace App\Controllers\Action;

use App\Controllers\AvailableActions;

class ActionCancel extends Action
{
    public static function getName()
    {
        return 'Отменить';
    }

    public static function getCode()
    {
        return 'act_cancel';
    }

    // check permissions
    public static function checkPermissions(int $init_user, AvailableActions $availableActions)
    {
        return $init_user === $availableActions->getCustomerId() && $availableActions->getCurrentStatus() === AvailableActions::STATUS_NEW;
    }
}
