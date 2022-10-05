<?php

namespace app\controllers;

use app\models\LoginForm;
use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\widgets\ActiveForm;

class LandingController extends Controller
{
    public $layout = 'landing';

    public function actions()
    {
        return [
            'error' => ['class' => 'yii\web\ErrorAction'],
        ];
    }

    public function actionIndex()
    {
        if (Yii::$app->user->getId()) {
            return $this->redirect('/tasks', 302);
        }

        $loginForm = new LoginForm();

        if (\Yii::$app->request->getIsPost()) {
            $loginForm->load(\Yii::$app->request->post());

            if (Yii::$app->request->isAjax && $loginForm->load(Yii::$app->request->post())) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($loginForm);
            }

            if ($loginForm->validate()) {
                $user = $loginForm->getUser();
                \Yii::$app->user->login($user);

                return $this->redirect('/tasks');
            }
        }
        return $this->render('index', ['model' => $loginForm]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

}
