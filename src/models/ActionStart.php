<?php

namespace tf\models;

class ActionStart extends AbstractAction
{

    public static function checkUserRoles(Task $task, $currentUserId): bool
    {
        if ($task->getCurrentStatus() === Task::STATUS_NEW && $task->getCustomerId() === $currentUserId) {
            return true;
        }
        return false;
    }

}
