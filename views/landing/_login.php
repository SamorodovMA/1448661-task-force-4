<?php

use app\models\LoginForm;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var $model LoginForm
 */
?>

<section class="modal enter-form form-modal" id="enter-form">
    <h2>Вход на сайт</h2>

    <?php $form = ActiveForm::begin( ['enableAjaxValidation' => true]); ?>

    <?= $form->field($model, 'email', [
        'template' => "{label}\n{input}\n{error}",
        'inputOptions' => ['class' => 'enter-form-email input input-middle'],
        'labelOptions' => ['class' => 'form-modal-description'],

    ]); ?>

    <?= $form->field($model, 'password', [
        'template' => "{label}\n{input}\n{error}",
        'inputOptions' => ['class' => 'enter-form-email input input-middle'],
        'labelOptions' => ['class' => 'form-modal-description'],
    ])->passwordInput(); ?>


    <?= Html::submitInput('Войти', ['class' => 'button']); ?>

    <?php ActiveForm::end() ?>

    <?= Html::button('Закрыть', ['class' => 'form-modal-close']); ?>
</section>