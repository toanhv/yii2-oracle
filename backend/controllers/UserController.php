<?php

namespace backend\controllers;

use Yii;
use common\models\User;
use backend\models\UserSearch;
use backend\controllers\AppController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends AppController {

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function beforeAction($action) {
        if (Yii::$app->user->isGuest) {
            $this->redirect('login');
        }
        return parent::beforeAction($action);
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        $model = $this->findModel($id);

        $role = \Yii::$app->authManager->getAssignment('admin', Yii::$app->user->getId());
        if (!$role) {
            if (Yii::$app->user->getId() != $model->ID) {
                throw new NotFoundHttpException('The requested page does not exist.');
            }
        }
        return $this->render('view', [
                    'model' => $model,
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new User();

        if ($model->load(Yii::$app->request->post())) {
            if (strlen($model->USERNAME) <= 255) {
                if ($model->save()) {
//                    \common\models\AUTHASSIGNMENTBase::deleteAll(['USER_ID' => $model->ID]);
//                    \Yii::$app->db->createCommand("insert into auth_assignment(item_name, user_id, created_at) values(:admin, :id, :time)", [
//                        'admin' => 'cc',
//                        'id' => $model->ID,
//                        'time' => time(),
//                    ])->execute();
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            } else {
                $model->addError('USERNAME', 'Người dùng phải nhỏ hơn 256 ký tự!');
            }
        }
        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        $role = \Yii::$app->authManager->getAssignment('admin', Yii::$app->user->getId());
        if (!$role) {
            if (Yii::$app->user->getId() != $model->ID) {
                throw new NotFoundHttpException('The requested page does not exist.');
            }
        }

        if ($model->load(Yii::$app->request->post())) {
            if (strlen($model->USERNAME) <= 255) {
                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            } else {
                $model->addError('USERNAME', 'Người dùng phải nhỏ hơn 256 ký tự!');
            }
        }
        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $model = $this->findModel($id);

        $role = \Yii::$app->authManager->getAssignment('admin', Yii::$app->user->getId());
        if (!$role) {
            if (Yii::$app->user->getId() != $model->ID) {
                throw new NotFoundHttpException('The requested page does not exist.');
            }
        }

        $model->delete();
        Yii::$app->session->setFlash('success', 'Xóa user thành công!');
        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
