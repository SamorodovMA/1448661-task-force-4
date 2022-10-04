<?php

namespace app\controllers;

use app\models\User;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class UserController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['view'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    public function actionView($id = null) {

        $user = User::findOne($id);

        if (!$user || !$user->is_executor){
            throw new NotFoundHttpException("Пользователя с ID $id не найден");
        }

        return $this->render('view', ['user'=> $user]);
    }
}
