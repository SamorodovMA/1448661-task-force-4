<?php

namespace tf\models;

class ActionResponse extends AbstractAction
{

    public static function checkUserRoles(Task $task, $currentUserId): bool
    {
        if ($task->getCurrentStatus() === Task::STATUS_NEW && $task->getExecutorId() === $currentUserId) {
            return true;
        }
        return false;
    }

}
