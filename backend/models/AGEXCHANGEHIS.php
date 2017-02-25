<?php

namespace backend\models;

use Yii;

class AGEXCHANGEHIS extends \common\models\AGEXCHANGEHISBase {

    public $fromTime;
    public $toTime;

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'EXCHANGE_HIS_ID' => Yii::t('backend', 'Exchange '),
            'ID_MAPPING' => Yii::t('backend', 'Số điện thoại'),
            'TYPE' => Yii::t('backend', 'Loại'),
            'VALUE' => Yii::t('backend', 'Giá trị'),
            'USERNAME' => Yii::t('backend', 'Username'),
            'PROCESS_TIME' => Yii::t('backend', 'Thời gian xử lý'),
            'INSERT_TIME' => Yii::t('backend', 'Thời gian'),
            'BAL_TYPE' => Yii::t('backend', 'Bal Type'),
            'TRANS_ID' => Yii::t('backend', 'Trans ID'),
            'FEE' => Yii::t('backend', 'Tiền'),
            'CP_NAME' => Yii::t('backend', 'Tên CP'),
            'TRANS_TYPE' => Yii::t('backend', 'Tài khoản'),
        ];
    }

    public function getTransType() {
        $text = '';
        switch (intval($this->TRANS_TYPE)) {
            case 0:
                $text = 'Trừ tiền';
                break;
            case 1:
                $text = 'Cộng tiền';
                break;
        }
        return $text;
    }

}
