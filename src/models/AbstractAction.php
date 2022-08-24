<?php

namespace tf\models;

abstract class AbstractAction
{
     public static function getActionName ($actionName) {
        return $actionName;
    }

     public static function getActionInnerActionName ($innerActionName) {
         return $innerActionName;
     }

    abstract public static function checkUserRoles (Task $task, $currentUserId);



}
