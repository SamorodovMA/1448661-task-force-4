<?php

use app\models\AddResponse;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var $responseForm AddResponse
 */
?>
<section class="pop-up pop-up--act_response pop-up--close">
    <div class="pop-up--wrapper">
        <h4>Добавление отклика к заданию</h4>
        <p class="pop-up-text">
            Вы собираетесь оставить свой отклик к этому заданию.
            Пожалуйста, укажите стоимость работы и добавьте комментарий, если необходимо.
        </p>
        <div class="addition-form pop-up--form regular-form">
            <?php
            $form = ActiveForm::begin([
                'id' => $responseForm->formName(),
                'enableAjaxValidation' => true,
            ]) ?>

            <?= $form->field($responseForm, 'comment', ['inputOptions' => ['class'=> null]])->textarea() ?>

            <?= $form->field($responseForm, 'price', ['inputOptions' => ['class'=> null]]) ?>

            <?= Html::submitInput('Завершить', ['class' => 'button button--pop-up button--blue']); ?>
        </div>
        <?php
        ActiveForm::end()
        ?>
        <div class="button-container">
            <button class="button--close" type="button">Закрыть окно</button>
        </div>
    </div>

</section>
