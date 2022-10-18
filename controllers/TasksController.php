<?php
namespace app\controllers;

use app\models\AddFeedback;
use app\models\addResponse;
use app\models\AddTaskForm;
use app\models\Task;
use app\models\TaskFilterForm;
use app\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Expression;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;

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
    public function actionView($id = null): array|string
    {
        $responseForm = new AddResponse();
        $feedBackForm = new AddFeedback();

        if (Yii::$app->request->getIsPost()) {
            $responseForm->load(Yii::$app->request->post());

            if (Yii::$app->request->isAjax && $responseForm->load(Yii::$app->request->post())) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($responseForm);
            }

            $currentExecutorId = $responseForm->getCurrentExecutorId();
            $currentTaskId = $id;
            $user = User::findOne($currentExecutorId);

            $response = \app\models\Response:: findOne(
                ['task_id' => $currentTaskId, 'executor_id' => $currentExecutorId]
            );
            if ($user->is_executor === User::EXECUTOR_RULE) {
                if ($responseForm->validate() && !$response) {
                    $responseForm->saveResponse($currentExecutorId, $currentTaskId);
                    $this->refresh();
                }
            }
        }

        if (Yii::$app->request->getIsPost()) {
            $feedBackForm->load(Yii::$app->request->post());

            if (Yii::$app->request->isAjax && $feedBackForm->load(Yii::$app->request->post())) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($feedBackForm);
            }
        }

        $addTask = new AddTaskForm();
        $task = Task::findOne($id);
        if (!$task) {
            throw new NotFoundHttpException("Задания с ID $id не найден");
        }
        return $this->render('view', [
            'task' => $task,
            'addTask' => $addTask,
            'responseForm' => $responseForm,
            'feedBackForm' => $feedBackForm
        ]);
    }

}
