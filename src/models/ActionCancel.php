<?php

namespace tf\models;

class ActionCancel extends AbstractAction
{

    public static function getActionName(): string
    {
        return 'Отмена задания';
    }

    public static function getActionInnerActionName(Task $task, $currentUserId)
    {
        if ($task->getCurrentStatus() === Task::STATUS_NEW && $task->getCustomerId() === $currentUserId ) {
            return true;
        }
        return false;
    }

    public static function checkUserRoles(): string
    {
        return 'ACTION_CANCEL';
    }
}
