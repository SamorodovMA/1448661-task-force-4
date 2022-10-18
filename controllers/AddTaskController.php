<?php

namespace app\controllers;

use app\models\AddTaskForm;
use app\models\User;
use Throwable;
use Yii;
use yii\filters\AccessControl;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\widgets\ActiveForm;

class AddTaskController extends SecuredController
{
    /**
     * Ограничение доступа к странице add-task
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'matchCallback' => function ($rule, $action) {
                            $currentUserId = Yii::$app->user->id;
                            $user = User::findOne($currentUserId);
                          return !($user->is_executor !== User::CUSTOMER_RULE);
                        }
                    ],
                ],
            ],
        ];
    }

    /**
     * @return array|string
     * @throws Throwable
     */
    public function actionIndex(): array|string
    {
        $addTaskForm = new AddTaskForm();

        if (Yii::$app->request->getIsPost()) {
            $addTaskForm->load(Yii::$app->request->post());

            if (Yii::$app->request->isAjax && $addTaskForm->load(Yii::$app->request->post())) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($addTaskForm);
            }

            if ($addTaskForm->validate()) {
                $currentTaskId = $addTaskForm->saveTask($addTaskForm->getCurrentCustomerId());

                $addTaskForm->taskFiles = UploadedFile::getInstances($addTaskForm, 'taskFiles');

                $filesPathsId = $addTaskForm->saveTaskFilesPaths($addTaskForm->uploadTaskFiles());

                $addTaskForm->saveTaskFiles($currentTaskId, $filesPathsId);

                Yii::$app->controller->redirect(['tasks/view', 'id' => $currentTaskId]);
            }
        }
        return $this->render('index', ['model' => $addTaskForm]);
    }
}
