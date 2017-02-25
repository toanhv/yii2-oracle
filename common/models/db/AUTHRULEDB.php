<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "AUTH_RULE".
 *
 * @property string $NAME
 * @property string $DATA
 * @property integer $CREATED_AT
 * @property integer $UPDATED_AT
 *
 * @property AUTHITEMDB[] $aUTHITEMs
 */
class AUTHRULEDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'AUTH_RULE';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['NAME'], 'required'],
            [['CREATED_AT', 'UPDATED_AT'], 'integer'],
            [['NAME'], 'string', 'max' => 64],
            [['DATA'], 'string', 'max' => 4000],
            [['NAME'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'NAME' => Yii::t('backend', 'Name'),
            'DATA' => Yii::t('backend', 'Data'),
            'CREATED_AT' => Yii::t('backend', 'Created  At'),
            'UPDATED_AT' => Yii::t('backend', 'Updated  At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAUTHITEMs()
    {
        return $this->hasMany(AUTHITEMDB::className(), ['RULE_NAME' => 'NAME']);
    }
}
