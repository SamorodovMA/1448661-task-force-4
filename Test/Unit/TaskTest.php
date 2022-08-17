<?php

use PHPUnit\Framework\TestCase;


class TaskTest extends TestCase
{

    private object $testTask;

    protected function setUp(): void
    {
        $this->testTask = new \tf\models\Task(1, 1);
    }

    /**
     *
     * @dataProvider providerGetStatusAfterAction
     */
    public function testGetStatusAfterAction($action, $status)
    {
        $this->assertSame($status, $this->testTask->getStatusAfterAction($action));
    }

    public function providerGetStatusAfterAction(): array
    {
        return [
            ['completion', 4],
            ['refusal', 5],
            ['cancel', 2],
            ['accept', 3],
            ['', 1]

        ];
    }

    /**
     *
     * @dataProvider providerGetAvailableActions
     */
    public function testGetAvailableActions($action)
    {
        $this->assertSame($action, $this->testTask->getAvailableActions(1));
    }

    public function providerGetAvailableActions()
    {
    }
}

