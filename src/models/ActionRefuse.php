<?php

namespace tf\models;

class ActionRefuse extends AbstractAction
{

    public static function checkUserRoles(Task $task, $currentUserId): bool
    {
        if ($task->getCurrentStatus() === Task::STATUS_WORKING && $task->getExecutorId() === $currentUserId) {
            return true;
        }
        return false;
    }
}
