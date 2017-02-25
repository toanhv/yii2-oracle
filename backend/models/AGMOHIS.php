<?php

namespace backend\models;

use Yii;

/**
 * @property AGMTHIS $mt
 */
class AGMOHIS extends \common\models\AGMOHISBase {

    public $fromTime;
    public $toTime;

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'MO_HIS_ID' => Yii::t('backend', 'Mo ID'),
            'ISDN' => Yii::t('backend', 'Số điện thoại'),
            'CONTENT' => Yii::t('backend', 'Nội dung'),
            'STATUS' => Yii::t('backend', 'Trạng thái'),
            'PROCESS_TIME' => Yii::t('backend', 'Thời gian xử lý'),
            'APP_ID' => Yii::t('backend', 'App ID'),
            'CHANNEL' => Yii::t('backend', 'Đầu số'),
            'RECEIVE_TIME' => Yii::t('backend', 'Thời gian'),
            'NODE_NAME' => Yii::t('backend', 'Node Name'),
            'CLUSTER_NAME' => Yii::t('backend', 'Cluster Name'),
            'MO_TRANS_ID' => Yii::t('backend', 'Mo Trans ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMt() {
        return $this->hasOne(AGMTHIS::className(), ['MO_TRANS_ID' => 'MO_TRANS_ID']);
    }

}
