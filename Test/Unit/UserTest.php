<?php

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{

    private object $user;

    protected function setUp(): void
    {
        $this->user = new \tf\models\User();
        $this->user->setAge(33);
    }
    protected function tearDown(): void
    {

    }

    /**
     * @dataProvider userProvider
     * @param $age
     * @return void
     */
    public function testAge($age) {
        $this->assertSame($age, $this->user->getAge());
    }

    public function userProvider () {
        return [
            'one' => [3],
            'two' =>[33],
            'correct' =>[33]
        ];
    }
}
