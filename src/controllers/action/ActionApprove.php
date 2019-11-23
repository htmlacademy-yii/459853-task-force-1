<?php


namespace App\Controllers\Action;

use App\Controllers\AvailableActions;

class ActionApprove extends Action
{
    public static function getName()
    {
        return 'Принято';
    }

    public static function getCode()
    {
        return 'approve';
    }

    // check permissions
    public static function checkPermissions(int $init_user, AvailableActions $availableActions)
    {
        return $init_user !== $availableActions->getEmploeeId();
    }
}
