<?php
namespace app\controllers;

use app\models\Task;
use yii\db\Query;
use yii\web\Controller;
class TasksController extends Controller
{
    public function actionIndex()
    {

        $query = new Query();
        $query->select(['tasks.name', 'tasks.description', 'tasks.budget', 'cities.name as city', 'tasks.date_creation']);
        $query->from('tasks');
        $query->join('LEFT JOIN', 'cities', 'tasks.city_id = cities.id');
        $query->where(['status' => 1]);
        $query->orderBy('date_creation DESC');

        $tasks =$query->all();

        return $this->render('index', compact('tasks'));
    }

}
