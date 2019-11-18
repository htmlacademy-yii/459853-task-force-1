<?php
    namespace App\Controllers\Action;

    abstract class Action
    {
        abstract static function getName($name);

        abstract static function getCode();

        abstract static function checkUserRole();
    }
