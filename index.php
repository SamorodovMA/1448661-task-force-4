<?php
require_once __DIR__ . '/util.php';
require_once __DIR__ . '/project-core/classes/Task.php';

$test = new Task('active', 'completion');

debug($test->getNameStatus());
debug($test->getAvailableActionsList());

var_dump( assert($test->getNameStatus()== Task::STATUS_NEW, 'CANCEL_ACTION'));
