<?php

/**
 * @var $model AddTaskForm
 */

use app\models\AddTaskForm;

?>


<main class="main-content main-content--center container">
    <div class="add-task-form regular-form">
        <?= $this->render('_addTaskForm', [
            'model' => $model
        ]); ?>
    </div>
</main>