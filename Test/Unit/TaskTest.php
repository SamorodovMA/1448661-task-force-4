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
            [Task::ACTION_COMPLETE, Task::STATUS_DONE],
            [Task::ACTION_REFUSE, Task::STATUS_FAILED],
            [Task::ACTION_CANCEL, Task::STATUS_CANCELLED],
            [Task::ACTION_START, Task::STATUS_WORKING]
        ];
    }

    /**
     * @dataProvider providerGetAvailableActions
     * @param $status
     * @param $action
     * @param $currentUserId
     * @return void
     */
    public function testGetAvailableActions($status, $action, $currentUserId)
    {
        $testAction = new Task($status, 123, 456);
        $this->assertSame($action, $testAction->getAvailableActions($currentUserId));
    }

    public function providerGetAvailableActions(): array
    {
        return [
            [Task::STATUS_NEW, [new \tf\models\ActionStart()], 123],
            [Task::STATUS_NEW, [new \tf\models\ActionCancel()], 123],
            [Task::STATUS_NEW, [new \tf\models\ActionResponse()], 456],
            [Task::STATUS_WORKING, [new \tf\models\ActionComplete()], 123],
            [Task::STATUS_WORKING, [new \tf\models\ActionRefuse()], 456]
        ];
    }
}
