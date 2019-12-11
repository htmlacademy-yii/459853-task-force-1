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

    public static function checkPermissions(int $initUser, AvailableActions $availableActions):bool
    {
        return $initUser === $availableActions->getCustomerId() && $availableActions->getCurrentStatus() === AvailableActions::STATUS_NEW;
    }
}
