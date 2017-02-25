<?php

namespace backend\controllers;

use common\models\LoginForm;
use Yii;

/**
 * Site controller
 */
class SiteController extends AppController {

    public $layout = 'default';

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'transparent' => true,
                'minLength' => 6,
                'maxLength' => 8,
            ],
        ];
    }

    public function actionIndex() {
        $this->layout = 'main';
        if (!Yii::$app->user->isGuest) {
            return $this->render('index');
        }
        $this->redirect('/login');
    }

    public function actionLogin() {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if (\Yii::$app->user->identity->IS_FIRST_LOGIN == 1) {
                $id = \Yii::$app->user->getId();
                Yii::$app->user->logout();
                return $this->redirect(['change', 'id' => $id]);
            }
            return $this->goBack();
        } else {
            return $this->render('login', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Change password an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionChange($id) {
        $model = \common\models\User::findOne(intval($id));
        if ($model) {
            $pass = $model->PASSWORD_HASH;
            if ($model->load(Yii::$app->request->post())) {
                $oldPass = trim(Yii::$app->request->post()[$model->formName()]['password_old']);
                if (password_verify($oldPass, $pass)) {
                    $passWeak = \Yii::$app->params['pass-weak'];
                    $newPass = trim(Yii::$app->request->post()[$model->formName()]['PASSWORD_HASH']);
                    $rePass = trim(Yii::$app->request->post()[$model->formName()]['re_password']);
                    if ($newPass == $rePass) {
                        if ($oldPass != $newPass) {
                            if (!in_array($newPass, $passWeak)) {
                                $model->IS_FIRST_LOGIN = 0;
                                if ($model->save(false)) {
                                    \Yii::$app->user->login($model, 1800);
                                    return $this->goHome();
                                }
                            } else {
                                $model->addError('PASSWORD_HASH', 'Mật khẩu mới chưa đủ mạnh!');
                            }
                        } else {
                            $model->addError('PASSWORD_HASH', 'Mật khẩu mới không được trùng với mật khẩu cũ!');
                        }
                    } else {
                        $model->addError('re_password', 'Mật khẩu gõ lại không đúng!');
                    }
                } else {
                    $model->addError('password_old', 'Mật khẩu cũ không đúng!');
                }
            }
            return $this->render('change', [
                        'model' => $model,
            ]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

}
