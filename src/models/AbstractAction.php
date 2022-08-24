<?php

namespace tf\models;

abstract class AbstractAction
{
    protected string $name;
    protected string $code;
    abstract public static function checkUserRoles (Task $task, $currentUserId): bool;
}
