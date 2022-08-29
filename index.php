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
    $fileNameCat = __DIR__ . './data/categories.csv';
    $newFileDirCat  = __DIR__ . './data/schema-sql/categories.sql';

    $categories = new DataConverter($fileNameCat, $newFileDirCat, 'categories');
    $data = $categories->csvToSql();
    $categories->createSqFile();
} catch (TaskException $e) {
    echo $e->getMessage();
}


try {
    $fileNameCities = __DIR__ . '/data/cities.csv';
    $newFileDirCities = __DIR__ . '/data/schema-sql/cities.sql';

    $cities = new DataConverter($fileNameCities, $newFileDirCities, 'cities');
    $data = $cities->csvToSql();
    $cities->createSqFile();
} catch (TaskException $e) {
    echo $e->getMessage();
}




