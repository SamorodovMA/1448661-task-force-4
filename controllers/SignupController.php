<?php

namespace app\controllers;

use app\models\City;
use app\models\User;
use Yii;
use yii\web\Controller;

class SignupController extends Controller
{

    public function actionIndex()
    {
        $cities = City::find()
            ->all();
        foreach ($cities as $city) {
            $citiesName[] = $city->name;
        }


        $user = new User();
        if (Yii::$app->request->getIsPost()) {
            $user->load(Yii::$app->request->post());

            if ($user->validate()) {
                $user->password = Yii::$app->security->generatePasswordHash($user->password);

                $user->save(false);
                $this->goHome();
            }
        }

        return $this->render('index', ['model' => $user, 'cities' => $citiesName]);
    }
}