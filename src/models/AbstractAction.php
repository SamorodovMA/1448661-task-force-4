<?php

namespace tf\models;

abstract class AbstractAction
{
private string $actionName;
private  string $innerActionName;
public function __construct(string $actionName, string $innerActionName)
{
    $this->actionName = $actionName;
    $this->innerActionName = $innerActionName;
}

    public function getActionName ():string
     {
        return $this->actionName;
    }

     public function getActionInnerActionName ():string
     {
        return $this->innerActionName;
     }

    abstract public static function checkUserRoles (Task $task, $currentUserId): bool;

}
