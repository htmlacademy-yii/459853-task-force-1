<?php

namespace App\Controllers\Action;

use App\Controllers\AvailableActions;

abstract class Action
{
    abstract static function getName();

    abstract static function getCode();

    abstract static function checkPermissions(int $init_user, AvailableActions $availableActions);
}
