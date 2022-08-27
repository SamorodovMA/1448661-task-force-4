<?php

namespace tf\models;

abstract class AbstractAction
{
    protected string $name;
    protected string $code;

    public function getName(): string
    {
        return $this->name;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    abstract public static function checkUserRoles(Task $task, $currentUserId): bool;
}
