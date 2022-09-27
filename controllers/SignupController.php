<?php

namespace app\controllers;

use app\models\City;
use app\models\User;
use yii\web\Controller;

class SignupController extends Controller
{

    public function actionIndex() {

        $cities = City::find()
            ->all();
        foreach ($cities as $city){
            $citiesName[] = $city->name;
        }


        $user = new User();

    return $this->render('index',  ['model' => $user, 'cities'=>  $citiesName]);

}
}