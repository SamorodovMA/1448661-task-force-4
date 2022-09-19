<?php
namespace app\controllers;

use app\models\Task;
use app\models\TaskFilterForm;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class TasksController extends Controller
{
    public function actionIndex()
    {
        $taskFilterForm = new TaskFilterForm();

     if($taskFilterForm->load(\Yii::$app->request->get())){
       echo '<pre>';
         print_r($taskFilterForm);
             echo '</pre>';
     }

        $tasksQuery = Task::find()
            ->where(['status' => Task::STATUS_NEW])
            ->with('category')
            ->with('city');

        $dataProvider = new ActiveDataProvider([
            'query' => $tasksQuery,
            'pagination' => [
                'pageSize' => 5,
            ],
            'sort' => [
                'defaultOrder' => [
                    'date_creation' => SORT_DESC,
                ]
            ],
        ]);

        return $this->render('index',
            ['dataProvider' => $dataProvider, 'taskFilterForm' => $taskFilterForm]
        );
    }

}
