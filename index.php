<?php

use tf\models\exception\TaskException;
use tf\models\Task;

require_once __DIR__ . '/util.php';
require_once __DIR__ . '/vendor/autoload.php';

try {
    $newTask = new Task(3, 123, 432);
} catch (TaskException $e) {
    echo $e->getMessage();
}
