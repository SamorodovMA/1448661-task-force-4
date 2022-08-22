<?php

namespace tf\models;

abstract class AbstractAction
{
    abstract public static function getActionName ();

    abstract public static function getActionInnerActionName (Task $task, $currentUserId);

    abstract public static function checkUserRoles ();

}
