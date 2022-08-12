<?php
require_once __DIR__ . '/util.php';
require_once __DIR__ . '/vendor/autoload.php';

use tf\classes\tasks\Task;

$test = new Task(1, 1);

debug($test->getAvailableActionsList('new'));
debug($test->getStatus('refusal'));
debug($test->getExecutorId());
var_dump( assert($test->getStatus('refusal')== Task::STATUS_NEW, 'CANCEL_ACTION'));

