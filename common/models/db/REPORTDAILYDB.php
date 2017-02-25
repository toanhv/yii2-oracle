<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "REPORT_DAILY".
 *
 * @property resource $DATA
 * @property string $TIME
 * @property integer $TYPE
 */
class REPORTDAILYDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'REPORT_DAILY';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TYPE'], 'integer'],
            [['DATA'], 'string', 'max' => 4000],
            [['TIME'], 'string', 'max' => 7]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'DATA' => Yii::t('backend', 'Data'),
            'TIME' => Yii::t('backend', 'Time'),
            'TYPE' => Yii::t('backend', 'Type'),
        ];
    }
}
