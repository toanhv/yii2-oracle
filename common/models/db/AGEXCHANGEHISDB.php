<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "AG_EXCHANGE_HIS".
 *
 * @property integer $EXCHANGE_HIS_ID
 * @property string $ID_MAPPING
 * @property string $TYPE
 * @property string $VALUE
 * @property string $USERNAME
 * @property string $PROCESS_TIME
 * @property string $INSERT_TIME
 * @property string $BAL_TYPE
 * @property string $TRANS_ID
 * @property integer $FEE
 * @property string $CP_NAME
 * @property string $TRANS_TYPE
 */
class AGEXCHANGEHISDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'AG_EXCHANGE_HIS';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['EXCHANGE_HIS_ID'], 'required'],
            [['EXCHANGE_HIS_ID', 'FEE'], 'integer'],
            [['ID_MAPPING'], 'string', 'max' => 200],
            [['TYPE', 'VALUE', 'BAL_TYPE', 'TRANS_TYPE'], 'string', 'max' => 10],
            [['USERNAME', 'TRANS_ID'], 'string', 'max' => 20],
            [['PROCESS_TIME', 'INSERT_TIME'], 'string', 'max' => 7],
            [['CP_NAME'], 'string', 'max' => 50],
            [['EXCHANGE_HIS_ID'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'EXCHANGE_HIS_ID' => Yii::t('backend', 'Exchange  His  ID'),
            'ID_MAPPING' => Yii::t('backend', 'Id  Mapping'),
            'TYPE' => Yii::t('backend', 'Type'),
            'VALUE' => Yii::t('backend', 'Value'),
            'USERNAME' => Yii::t('backend', 'Username'),
            'PROCESS_TIME' => Yii::t('backend', 'Process  Time'),
            'INSERT_TIME' => Yii::t('backend', 'Insert  Time'),
            'BAL_TYPE' => Yii::t('backend', 'Bal  Type'),
            'TRANS_ID' => Yii::t('backend', 'Trans  ID'),
            'FEE' => Yii::t('backend', 'Fee'),
            'CP_NAME' => Yii::t('backend', 'Cp  Name'),
            'TRANS_TYPE' => Yii::t('backend', 'Trans  Type'),
        ];
    }
}
