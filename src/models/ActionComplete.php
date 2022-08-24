<?php

namespace tf\models;

class ActionComplete extends AbstractAction
{

    public static function checkUserRoles(Task $task, $currentUserId): bool
    {
        if ($task->getCurrentStatus() === Task::STATUS_NEW && $task->getCustomerId() === $currentUserId) {
            return true;
        }

        if ($task->getCurrentStatus() === Task::STATUS_WORKING && $task->getExecutorId() === $currentUserId) {
            return true;
        }

        return false;
    }

}
