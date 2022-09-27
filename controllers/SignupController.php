<?php

namespace app\controllers;

use app\models\User;
use yii\web\Controller;

class SignupController extends Controller
{

    public function actionIndex() {
        $user = new User();

    return $this->render('index',  ['model' => $user]);

}
}