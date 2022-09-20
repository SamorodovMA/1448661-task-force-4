<?php
namespace app\controllers;

use app\models\Task;
use app\models\TaskFilterForm;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class TasksController extends Controller
{
    public function actionIndex()
    {
        $taskFilterForm = new TaskFilterForm();
        var_dump(\Yii::$app->request->post());
        if($taskFilterForm->load(\Yii::$app->request->post())) {

            echo '<pre>';
            // var_dump($taskFilterForm);
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

    /**
     * @throws NotFoundHttpException
     */
    public function actionView($id = null) {
        $task = Task::findOne($id);
        if (!$task) {
            throw new NotFoundHttpException("Задания с id ' {$id} 'не существует");
        }
        print_r($task);
        return $this->render('view');
    }

    public function actionUser() {

        return $this->render('user');
    }

}
