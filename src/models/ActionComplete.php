<?php

namespace tf\models;

class ActionComplete extends AbstractAction
{

    public static function getActionName(): string
    {
        return 'Завершить задание';
    }

    public static function getActionInnerActionName(Task $task, $currentUserId): bool
    {
        if ($task->getCurrentStatus() === Task::STATUS_NEW && $task->getCustomerId() === $currentUserId) {
            return true;
        }

        if ($task->getCurrentStatus() === Task::STATUS_WORKING && $task->getExecutorId() === $currentUserId) {
            return true;
        }

        return false;
    }

    public static function checkUserRoles(): string
    {
        return 'Завершить задание';
    }
}
