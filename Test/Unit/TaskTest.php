<?php

use PHPUnit\Framework\TestCase;
use tf\models\Task;


class TaskTest extends TestCase
{

    /**
     * @dataProvider providerGetStatusAfterAction
     */
    public function testGetStatusAfterAction($action, $status)
    {
        $testStatus = new Task(Task::STATUS_NEW, 123);
        $this->assertSame($status, $testStatus->getStatusAfterAction($action));
    }

    public function providerGetStatusAfterAction(): array
    {
        return [
            [Task::ACTION_COMPLETION, Task::STATUS_DONE],
            [Task::ACTION_REFUSAL, Task::STATUS_FAILED],
            [Task::ACTION_CANCEL, Task::STATUS_CANCELLED],
            [Task::ACTION_ACCEPT, Task::STATUS_ACTIVE],
            ['', Task::STATUS_NEW]

        ];
    }

    /**
     * @dataProvider providerGetAvailableActions
     * @param $action
     * @param $currentUserId
     * @return void
     */
    public function testGetAvailableActions($action, $currentUserId)
    {
        $testAction = new Task(Task::STATUS_NEW, 123, 456);
        $this->assertSame($action, $testAction->getAvailableActions($currentUserId));
    }

    public function providerGetAvailableActions(): array
    {
        return [
            [Task::ACTION_CANCEL, 123],
            [Task::ACTION_RESPONSE, 456],
            [Task::ACTION_COMPLETION, 123],
            [Task::ACTION_REFUSAL, 456]
        ];
    }

}
