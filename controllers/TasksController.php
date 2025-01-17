<?php
namespace app\controllers;

use app\models\AddTaskForm;
use app\models\Task;
use app\models\TaskFilterForm;
use yii\data\ActiveDataProvider;
use yii\db\Expression;
use yii\web\NotFoundHttpException;

class TasksController extends SecuredController
{

    public function actionIndex(): string
    {
        $taskFilterForm = new TaskFilterForm();

        $tasksQuery = Task::find()
            ->where(['status' => Task::STATUS_NEW])
            ->with('category')
            ->with('city');

        if ($taskFilterForm->load(\Yii::$app->request->get())) {
            if ($taskFilterForm->categories) {
                $tasksQuery->where(['in', 'category_id', $taskFilterForm->categories]);
            }
            if ($taskFilterForm->remoteWork) {
                $tasksQuery->where(['is_remote' => $taskFilterForm->remoteWork]);
            }
            if ($taskFilterForm->withoutResponses) {
                $tasksQuery->leftJoin('response', 'tasks.id = response.task_id')
                    ->where(['is', 'task_id', null]);
            }
            switch ($taskFilterForm->period) {
                case 'hour':
                    $tasksQuery->where(['>', 'date_creation', new Expression('CURRENT_TIMESTAMP() - INTERVAL 1 HOUR')]);
                    break;
                case 'day':
                    $tasksQuery->where(['>', 'date_creation', new Expression('CURRENT_TIMESTAMP() - INTERVAL 1 DAY')]);
                    break;
                case 'week':
                    $tasksQuery->where(['>', 'date_creation', new Expression('CURRENT_TIMESTAMP() - INTERVAL 7 DAY')]);
                    break;
            }
        }

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
    public function actionView($id=null): string
    {

        $addTask = new AddTaskForm();
        $task = Task::findOne($id);
        if (!$task) {
            throw new NotFoundHttpException("Задания с ID $id не найден");
        }
        return $this->render('view', ['task' => $task, 'addTask' => $addTask]);
    }

}
