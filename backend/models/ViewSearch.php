<?php

namespace backend\models;

use Yii;

class ViewSearch extends \yii\db\ActiveRecord {

    public $fromTime;
    public $toTime;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['fromTime', 'toTime'], 'trim'],
            [['fromTime', 'toTime'], 'date', 'format' => 'php:Y-m-d', 'message' => 'Định dạng thời gian không hợp lệ'],
            [['toTime'], 'compare', 'compareAttribute' => 'fromTime', 'operator' => '>=', 'type' => 'date', 'message' => Yii::t('backend', 'Đến ngày phải lớn hơn hoặc bằng Từ ngày')],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'fromTime' => Yii::t('backend', 'Từ ngày'),
            'toTime' => Yii::t('backend', 'Đến ngày'),
        ];
    }

}
