<?php
/**
 * @var $feedBackForm AddFeedback
 */

use app\components\StarRating;
use app\models\AddFeedback;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<section class="pop-up pop-up--completion pop-up--close">
    <div class="pop-up--wrapper">
        <h4>Завершение задания</h4>
        <p class="pop-up-text">
            Вы собираетесь отметить это задание как выполненное.
            Пожалуйста, оставьте отзыв об исполнителе и отметьте отдельно, если возникли проблемы.
        </p>
        <div class="completion-form pop-up--form regular-form">
            <?php
            $form = ActiveForm::begin([
                'id' => $feedBackForm->formName(),
                'enableAjaxValidation' => true,
            ])

            ?>

            <?= $form->field($feedBackForm, 'comment', ['inputOptions' => ['class'=> null]])->textarea(); ?>



            <p class="completion-head control-label">Оценка работы</p>
            <div class="stars-rating big active-stars">
                <span>&nbsp;</span><span>&nbsp;</span><span>&nbsp;</span><span>&nbsp;</span><span>&nbsp;</span>
            </div>



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