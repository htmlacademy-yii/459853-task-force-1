<?php
declare(strict_types=1);

namespace App\Controllers\Action;

use App\Controllers\AvailableActions;

class ActionFailed extends Action
{
    public static function getName():string
    {
        return 'Провалено';
    }

    public static function getCode():string
    {
        return 'act_failed';
    }

    public static function checkPermissions(int $initUser, AvailableActions $availableActions):bool
    {
        return $initUser === $availableActions->getCustomerId() && $availableActions->getCurrentStatus() === AvailableActions::STATUS_STARTED;
    }
}
