<?php

namespace console\controllers;

use common\models\User;
use yii\console\Controller;

class RbacController extends Controller {

    public function actionInit() {
        User::deleteAll(['USERNAME' => 'toanhv9']);
        $user = new User();
        $user->USERNAME = "toanhv9";
        $user->EMAIL = "toanhv9@viettel.com.vn";
        $user->STATUS = 1;
        $user->PASSWORD_HASH = 'Admin@123';
        if ($user->save(false)) {
            \common\models\AUTHASSIGNMENTBase::deleteAll(['USER_ID' => $user->ID]);
            \Yii::$app->db->createCommand("insert into auth_assignment(item_name, user_id, created_at) values(:admin, :id, :time)", [
                'admin' => 'admin',
                'id' => $user->ID,
                'time' => time(),
            ])->execute();
        }
    }

}
