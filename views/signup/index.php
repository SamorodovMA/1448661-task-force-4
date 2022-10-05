<?php

/** @var yii\web\View $this
 * @var $model SignupForm
 */

use app\models\SignupForm;

?>
<main class="container container--registration">
    <div class="center-block">
        <div class="registration-form regular-form">

            <?= $this->render('_signupForm', [
                'model' => $model
            ]); ?>
        </div
    </div>
</main>
