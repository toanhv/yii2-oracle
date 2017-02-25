<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "AG_MO_HIS".
 *
 * @property integer $MO_HIS_ID
 * @property string $ISDN
 * @property string $CONTENT
 * @property integer $STATUS
 * @property string $PROCESS_TIME
 * @property string $APP_ID
 * @property string $CHANNEL
 * @property string $RECEIVE_TIME
 * @property string $NODE_NAME
 * @property string $CLUSTER_NAME
 * @property string $MO_TRANS_ID
 */
class AGMOHISDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'AG_MO_HIS';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['MO_HIS_ID'], 'required'],
            [['MO_HIS_ID', 'STATUS'], 'integer'],
            [['RECEIVE_TIME'], 'safe'],
            [['ISDN', 'MO_TRANS_ID'], 'string', 'max' => 20],
            [['CONTENT'], 'string', 'max' => 200],
            [['PROCESS_TIME'], 'string', 'max' => 7],
            [['APP_ID', 'NODE_NAME', 'CLUSTER_NAME'], 'string', 'max' => 50],
            [['CHANNEL'], 'string', 'max' => 10],
            [['MO_HIS_ID'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'MO_HIS_ID' => Yii::t('backend', 'Mo  His  ID'),
            'ISDN' => Yii::t('backend', 'Isdn'),
            'CONTENT' => Yii::t('backend', 'Content'),
            'STATUS' => Yii::t('backend', 'Status'),
            'PROCESS_TIME' => Yii::t('backend', 'Process  Time'),
            'APP_ID' => Yii::t('backend', 'App  ID'),
            'CHANNEL' => Yii::t('backend', 'Channel'),
            'RECEIVE_TIME' => Yii::t('backend', 'Receive  Time'),
            'NODE_NAME' => Yii::t('backend', 'Node  Name'),
            'CLUSTER_NAME' => Yii::t('backend', 'Cluster  Name'),
            'MO_TRANS_ID' => Yii::t('backend', 'Mo  Trans  ID'),
        ];
    }
}
