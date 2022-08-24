<?php

namespace tf\models;

class ActionCancel extends AbstractAction
{
    protected string $name = 'Отмена задания';
    protected string $code = 'ACTION_CANCEL';

    public static function checkUserRoles(Task $task, $currentUserId): bool
    {
        if ($task->getCurrentStatus() === Task::STATUS_NEW && $task->getCustomerId() === $currentUserId) {
            return true;
        }
        return false;
    }
}
