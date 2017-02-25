<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "AG_CP".
 *
 * @property integer $CP_ID
 * @property string $CP_NAME
 * @property string $UPDATE_TIME
 * @property string $DESCRIPTION
 * @property integer $STATUS
 * @property string $ISDN_RANGE
 * @property string $CDR_PATTERN
 */
class AGCPDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'AG_CP';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CP_ID', 'STATUS'], 'integer'],
            [['CP_NAME'], 'required'],
            [['CP_NAME'], 'string', 'max' => 50],
            [['UPDATE_TIME'], 'string', 'max' => 7],
            [['DESCRIPTION'], 'string', 'max' => 500],
            [['ISDN_RANGE', 'CDR_PATTERN'], 'string', 'max' => 200],
            [['CP_NAME'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CP_ID' => Yii::t('backend', 'Cp  ID'),
            'CP_NAME' => Yii::t('backend', 'Cp  Name'),
            'UPDATE_TIME' => Yii::t('backend', 'Update  Time'),
            'DESCRIPTION' => Yii::t('backend', 'Description'),
            'STATUS' => Yii::t('backend', 'Status'),
            'ISDN_RANGE' => Yii::t('backend', 'Isdn  Range'),
            'CDR_PATTERN' => Yii::t('backend', 'Cdr  Pattern'),
        ];
    }
}
