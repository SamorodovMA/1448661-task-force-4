<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<main class="container container--registration">
    <div class="center-block">
        <div class="registration-form regular-form">

                <?php $form = ActiveForm::begin()?>
                <h3 class="head-main head-task">Регистрация нового пользователя</h3>
                <div class="form-group">
                 <?=$form->field($model, 'name') ?>
                </div>
                <div class="half-wrapper">
                    <div class="form-group">
                        <?=$form->field($model, 'email') ?>
                    </div>
                    <div class="form-group">
                        <?=$form->field($model, 'city_id') ?>
                    </div>
                </div>
                <div class="half-wrapper">
                    <div class="form-group">
                   <?=$form->field($model, 'password') ?>
                    </div>
                </div>
                <div class="half-wrapper">

                    <div class="form-group">
                        <?=$form->field($model, 'password_repeat') ?>
                    </div>
                </div>
                <div class="form-group">
                    <?= $form->field($model, 'is_executor')->checkbox()?>
                </div>
            <?=Html::submitInput('Создать аккаунт', ['class' => 'button button--blue'])?>
            <?php ActiveForm::end() ?>
        </div>
    </div>
</main>
