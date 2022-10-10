<?php

use app\models\AddTaskForm;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var $model AddTaskForm
 */
?>

<?php $form = ActiveForm::begin(
    [
        'id' => $model->formName(),
        'enableAjaxValidation' => true,
        'options' => ['enctype' => 'multipart/form-data'],
        'fieldConfig' => [
            'labelOptions' => ['class' => 'control-label'],
            'errorOptions' => ['tag' => 'span', 'class' => 'help-block'],
        ],
    ]
) ?>

<h3 class="head-main head-main">Публикация нового задания</h3>
<?= $form->field($model, 'title', ['inputOptions' => ['class'=> null]]); ?>

<?= $form->field($model, 'description')->textarea(); ?>

<?= $form->field($model, 'category_id')->dropDownList($model->getCategory()); ?>

<?= $form->field($model, 'location', ['inputOptions' => ['class'=> 'location-icon']]); ?>
<div class="half-wrapper">
<?= $form->field($model, 'budget', ['inputOptions' => ['class'=> 'budget-icon']]); ?>

<?= $form->field($model, 'period_execution')->Input('date'); ?>
</div>

<?= $form->field($model, 'taskFiles[]', [
    'template' => " <label class=\"new-file\" >Добавить новый файл{input}",
    'inputOptions' => ['style'=>'display: none' ],

])->fileInput(['multiple' => true]); ?>

<?= Html::submitInput('Опубликовать', ['class' => 'button button--blue']); ?>
<?php ActiveForm::end() ?>


