<?php

use tf\models\Task;

require_once __DIR__ . '/util.php';
require_once __DIR__ . '/vendor/autoload.php';

$newTask = new Task(1, 123);


$test = new \tf\models\ActionCancel();
echo $test->getName();
echo $test->getCode();
