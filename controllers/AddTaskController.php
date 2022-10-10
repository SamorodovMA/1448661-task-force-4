<?php

namespace app\controllers;

use app\models\AddTaskForm;
use Yii;
use yii\helpers\Url;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\widgets\ActiveForm;

class AddTaskController extends SecuredController
{
    public function actionIndex()
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