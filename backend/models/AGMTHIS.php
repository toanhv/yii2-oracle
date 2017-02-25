<?php

namespace backend\models;

use Yii;

class AGMTHIS extends \common\models\AGMTHISBase {

    public $fromTime;
    public $toTime;

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'MT_HIS_ID' => Yii::t('backend', 'Mt ID'),
            'ISDN' => Yii::t('backend', 'Số điện thoại'),
            'MESSAGE' => Yii::t('backend', 'Nội dung'),
            'MO_TRANS_ID' => Yii::t('backend', 'Mo Trans ID'),
            'MT_TRANS_ID' => Yii::t('backend', 'Mt Trans ID'),
            'RETRY_COUNT' => Yii::t('backend', 'Retry Count'),
            'SENT_TIME' => Yii::t('backend', 'Thời gian gửi'),
            'STATUS' => Yii::t('backend', 'Trạng thái'),
            'APP_ID' => Yii::t('backend', 'App ID'),
            'RECEIVE_TIME' => Yii::t('backend', 'Thời gian'),
            'CHANNEL' => Yii::t('backend', 'Đầu số'),
            'NODE_NAME' => Yii::t('backend', 'Node Name'),
            'CLUSTER_NAME' => Yii::t('backend', 'Cluster Name'),
        ];
    }

}
