<?php

namespace backend\models;

use Yii;

class AGCP extends \common\models\AGCPBase {

    public static function getAll() {
        $return = [];
        $cps = AGCP::find()->orderBy(['CP_NAME' => SORT_ASC])->all();
        foreach ($cps as $item) {
            $return[\yii\helpers\Html::encode($item->CP_NAME)] = \yii\helpers\Html::encode($item->CP_NAME);
        }
        return $return;
    }

}
