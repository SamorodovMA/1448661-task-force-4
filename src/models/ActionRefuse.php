<?php

namespace tf\models;

class ActionRefuse extends AbstractAction
{

    public static function getActionName(): string
    {
       return 'Отказаться от задания';
    }

    public static function getActionInnerActionName(Task $task, $currentUserId): bool
    {
        if ($task->getCurrentStatus() === Task::STATUS_WORKING && $task->getExecutorId()===$currentUserId) {
            return true;
        }
        return false;
    }

    public static function checkUserRoles(): string
    {
       return 'ACTION_REFUSE';
    }
}
