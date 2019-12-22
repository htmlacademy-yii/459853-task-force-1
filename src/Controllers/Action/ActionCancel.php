<?php
declare(strict_types=1);

namespace App\Controllers\Action;

use App\Controllers\AvailableActions;

class ActionCancel extends Action
{
    public static function getName():string
    {
        return 'Отменить';
    }

    public static function getCode():string
    {
        return 'act_cancel';
    }

    public static function checkPermissions(int $initUser, AvailableActions $availableActions):bool
    {
        return $initUser === $availableActions->getCustomerId() && $availableActions->getCurrentStatus() === AvailableActions::STATUS_NEW;
    }
}
