<?php

class Task
{
    public array $statuses = [];
    public array $actions = [];
    public array $statusesAndActionsMaps = [];


    public string $currentActions;


    public static int $userId;
    public static int $customerId;


    public function __construct($userId, $customerId)
    {
        self::$userId = $userId;
        self::$customerId =$customerId;
    }

    public function getStatuses(): array
    {
        return $this->statuses;
    }


    public function getActions(): array
    {
        return $this->actions;
    }


    public static function getUserId(): int
    {
        return self::$userId;
    }

    public static function getCustomerId(): int
    {
        return self::$customerId;
    }

    public function getCurrentActions(): string
    {
        return $this->currentActions;
    }

    public function getStatusesAndActionsMaps(): array
    {
        return $this->statusesAndActionsMaps;
    }



    public function setCurrentActions(string $currentActions): void
    {
        $this->currentActions = $currentActions;
    }

}
