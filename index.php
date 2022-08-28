<?php

use tf\models\DataConverter;
use tf\models\exception\TaskException;
use tf\models\Task;

require_once __DIR__ . '/util.php';
require_once __DIR__ . '/vendor/autoload.php';

try {
    $newTask = new Task(1, 123);
    $newTask->getStatusAfterAction($newTask::ACTION_COMPLETE);
} catch (TaskException $e) {
    echo $e->getMessage();
}

try {
    $dir = $_SERVER['DOCUMENT_ROOT'] . '/' . 'data' . '/' . 'cities' . '.sql';
    $path = __DIR__ . '/data/cities.csv';

    $test = new DataConverter($path, $dir, 'cities');
  $data = $test->csvToSql($path);

  $test->createSqFile($dir, $data);

} catch (TaskException $e) {
    echo $e->getMessage();
}





