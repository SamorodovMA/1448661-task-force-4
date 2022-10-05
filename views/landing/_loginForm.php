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

    <?php
    $form = ActiveForm::begin([
        'id' => $model->formName(),
        'enableAjaxValidation' => true,

        'fieldConfig' => [
            'inputOptions' => ['class' => 'enter-form-email input input-middle'],
            'labelOptions' => ['class' => 'form-modal-description'],
        ],
    ]);
    ?>

    <?= $form->field($model, 'email')->error(['tag' => 'div', 'style' => 'margin-bottom: 20px;']); ?>

    <?= $form->field($model, 'password')->passwordInput()->error(['tag' => 'div', 'style' => 'margin-bottom: 20px;']
    );; ?>


    <?= Html::submitInput('Войти', ['class' => 'button']); ?>

    <?php
    ActiveForm::end() ?>

    <?= Html::button('Закрыть', ['class' => 'form-modal-close']); ?>
</section>
