<?php
namespace app\controllers;
use app\models\Category;
use app\models\City;
use app\models\Task;
use yii\web\Controller;
class TasksController extends Controller
{
    public function actionIndex()
    {
        $tasks = Task::find()->all();
        return $this->render('index', compact('tasks'));
    }

}