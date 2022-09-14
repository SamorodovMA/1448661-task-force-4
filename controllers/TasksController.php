<?php
namespace app\controllers;

use app\models\Task;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class TasksController extends Controller
{
    public function actionIndex()
    {
        $tasksQuery = Task::find()
            ->where(['status' => Task::STATUS_NEW])
            ->with('category')
            ->with('city');

        $dataProvider = new ActiveDataProvider([
            'query' => $tasksQuery,
            'pagination' => [
                'pageSize' => 1,
            ],
            'sort' => [
                'defaultOrder' => [
                    'date_creation' => SORT_DESC,
                ]
            ],
        ]);

        return $this->render(
            'index',
            [
               // 'tasks' => $dataProvider->getModels(),
                'dataProvider' => $dataProvider
            ]
        );
    }

}
