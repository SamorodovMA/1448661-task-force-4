<?php

use tf\models\exception\TaskException;
use tf\models\Task;

require_once __DIR__ . '/util.php';
require_once __DIR__ . '/vendor/autoload.php';

try {
    $newTask = new Task(1, 123, 234);
    debug($newTask->getActionsList());
    debug($newTask::ACTION_CANCEL);
    debug($newTask->getStatusAfterAction($newTask::ACTION_COMPLETE));

} catch (TaskException $e) {
    echo $e->getMessage();
}


