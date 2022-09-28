<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<main class="container container--registration">
    <div class="center-block">
        <div class="registration-form regular-form">

            <?php
            $form = ActiveForm::begin(['id' => 'signup-form',]); ?>

            <h3 class="head-main head-task">Регистрация нового пользователя</h3>
            <?= $form->field($model, 'name') ?>
            <div class="half-wrapper">
                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'city_id')->dropDownList($cities) ?>
            </div>
            <div class="half-wrapper">
                <?= $form->field($model, 'password')->passwordInput() ?>
            </div>
            <div class="half-wrapper">
                <?= $form->field($model, 'password_repeat')->passwordInput() ?>
            </div>
            <?= $form->field($model, 'is_executor')->checkbox() ?>

            <?= Html::submitInput('Создать аккаунт', ['class' => 'button button--blue']) ?>

            <?php
            ActiveForm::end() ?>
        </div>
    </div>
</main>
