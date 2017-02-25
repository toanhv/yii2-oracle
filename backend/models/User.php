<?php

namespace backend\models;

use common\models\User as UserBase;

class User extends UserBase {

    public static function getAllUser() {
        $users = User::find()->all();
        $arrUser = array();
        foreach ($users as $user) {
            $arrUser[$user['ID']] = $user['USERNAME'];
        }
        return $arrUser;
    }

    public static function getName($userId) {
        $users = User::find()->where(['ID' => intval($userId)])->one();
        if ($users) {
            return \yii\helpers\Html::encode($users->USERNAME);
        }
        return '';
    }

}
