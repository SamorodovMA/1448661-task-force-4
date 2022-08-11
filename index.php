<?php
require_once __DIR__ . '/util.php';
require_once __DIR__ . '/vendor/autoload.php';

use tf\classes\tasks\Task;

$test = new Task('active', 'completion');

debug($test->getStatusName());
debug($test->getAvailableActionsList());

var_dump( assert($test->getStatusName()== Task::STATUS_NEW, 'CANCEL_ACTION'));
