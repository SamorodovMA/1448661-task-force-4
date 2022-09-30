<?php

namespace app\controllers;

use app\models\City;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class SignupController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['?'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $cities = City::find()
            ->asArray()
            ->all();
        $cityNames = ArrayHelper::map($cities, 'id', 'name');



        $user = new User();
        if (Yii::$app->request->getIsPost()) {
            $user->load(Yii::$app->request->post());

            if ($user->validate()) {
                $user->password = Yii::$app->security->generatePasswordHash($user->password);

                $user->save();
                $this->goHome();
            }
        }

        return $this->render('index', ['model' => $user, 'cities' => $cityNames]);
    }
}
