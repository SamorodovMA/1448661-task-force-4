<?php

namespace tf\models;

class ActionRefuse extends AbstractAction
{
    protected string $name = 'Отказаться от задания';
    protected string $code = 'ACTION_REFUSE';

    public static function checkUserRoles(Task $task, $currentUserId): bool
    {
        if ($task->getCurrentStatus() === Task::STATUS_WORKING && $task->getExecutorId() === $currentUserId) {
            return true;
        }
        return false;
    }
}
