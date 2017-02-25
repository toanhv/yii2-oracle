<?php

namespace backend\models;

use Yii;

class Menu extends \common\models\MenuBase {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['ID', 'PARENT', 'PRIORITY'], 'integer'],
            [['NAME'], 'string', 'max' => 128],
            [['NAME'], 'trim'],
            [['ROUTE', 'DATA'], 'string', 'max' => 256],
            [['ID'], 'unique']
        ];
    }

}
