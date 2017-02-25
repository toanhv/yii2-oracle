<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "AG_MT_HIS".
 *
 * @property integer $MT_HIS_ID
 * @property string $ISDN
 * @property string $MESSAGE
 * @property string $MO_TRANS_ID
 * @property string $MT_TRANS_ID
 * @property integer $RETRY_COUNT
 * @property string $SENT_TIME
 * @property integer $STATUS
 * @property string $APP_ID
 * @property string $RECEIVE_TIME
 * @property string $CHANNEL
 * @property string $NODE_NAME
 * @property string $CLUSTER_NAME
 */
class AGMTHISDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'AG_MT_HIS';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['MT_HIS_ID'], 'required'],
            [['MT_HIS_ID', 'RETRY_COUNT', 'STATUS'], 'integer'],
            [['ISDN', 'MO_TRANS_ID', 'MT_TRANS_ID'], 'string', 'max' => 20],
            [['MESSAGE'], 'string', 'max' => 2000],
            [['SENT_TIME', 'RECEIVE_TIME'], 'string', 'max' => 7],
            [['APP_ID', 'NODE_NAME', 'CLUSTER_NAME'], 'string', 'max' => 50],
            [['CHANNEL'], 'string', 'max' => 10],
            [['MT_HIS_ID'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'MT_HIS_ID' => Yii::t('backend', 'Mt  His  ID'),
            'ISDN' => Yii::t('backend', 'Isdn'),
            'MESSAGE' => Yii::t('backend', 'Message'),
            'MO_TRANS_ID' => Yii::t('backend', 'Mo  Trans  ID'),
            'MT_TRANS_ID' => Yii::t('backend', 'Mt  Trans  ID'),
            'RETRY_COUNT' => Yii::t('backend', 'Retry  Count'),
            'SENT_TIME' => Yii::t('backend', 'Sent  Time'),
            'STATUS' => Yii::t('backend', 'Status'),
            'APP_ID' => Yii::t('backend', 'App  ID'),
            'RECEIVE_TIME' => Yii::t('backend', 'Receive  Time'),
            'CHANNEL' => Yii::t('backend', 'Channel'),
            'NODE_NAME' => Yii::t('backend', 'Node  Name'),
            'CLUSTER_NAME' => Yii::t('backend', 'Cluster  Name'),
        ];
    }
}
