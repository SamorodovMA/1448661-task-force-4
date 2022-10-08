<?php

namespace app\controllers;

use app\models\User;
use yii\web\NotFoundHttpException;

class UserController extends SecuredController
{

    public function actionView($id = null)
    {
        $user = User::findOne($id);

        if (!$user || !$user->is_executor) {
            throw new NotFoundHttpException("Пользователя с ID $id не найден");
        }

        return $this->render('view', ['user'=> $user]);
    }
}
