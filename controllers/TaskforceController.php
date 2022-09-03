<?php
namespace app\controllers;
use app\models\Category;
use app\models\City;
use yii\web\Controller;
class TaskforceController extends Controller
{
    public function actionIndex()
    {
        $city = City::find()->all();
        $categories = Category::find()->all();

        return $this->render('index', ['city'=>$city, 'categories' => $categories]);
    }
}