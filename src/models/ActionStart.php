<?php

namespace tf\models;

class ActionStart extends AbstractAction
{

    public static function getActionName():string
    {
        return 'Принять';
    }

    public static function getActionInnerActionName(Task $task, $currentUserId):bool
    {
        if ($task->getCurrentStatus() === Task::STATUS_NEW && $task->getCustomerId() === $currentUserId) {
            return true;
        }
        return false;
    }

    public static function checkUserRoles(): string
    {
        return 'ACTION_START';
    }
}