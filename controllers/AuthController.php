<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\User;
use app\models\LoginForm;
use app\models\SignupForm;
use Yii;

class AuthController extends Controller 
{
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) { //проверка на авторизованость
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {//если вошедший гость то приступить к авторизации
        return $this->goBack();
        }

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionSignup()
    {
        $model = new SignupForm();

        if(Yii::$app->request->isPost)
        {
            $model->load(Yii::$app->request->post());
            if($model->signup())
            {
                return $this->redirect(['auth/login']);
            }
        }

        return $this->render('signup', ['model'=>$model]);
    }

    public function actionTest()
    {
        $user = User::findOne(1);
        Yii::$app->user->logout();

        if(Yii::$app->user->isGuest)
        {
            echo 'Guest';
       }
        else 
        {
            echo 'Autorizate';
        }
    }
}
