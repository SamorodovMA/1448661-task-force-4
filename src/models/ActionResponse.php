<?php

namespace tf\models;

class ActionResponse extends AbstractAction
{

    public static function getActionName(): string
    {
        return 'Откликнуться на задание';
    }

    public static function getActionInnerActionName(Task $task, $currentUserId): bool
    {
        if ($task->getCurrentStatus() === Task::STATUS_NEW && $task->getExecutorId() === $currentUserId) {
            return true;
        }
        return false;
    }

    public static function checkUserRoles(): string
    {
       return 'ACTION_RESPONSE';
    }
}
