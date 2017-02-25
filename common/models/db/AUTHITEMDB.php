<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "AUTH_ITEM".
 *
 * @property string $NAME
 * @property integer $TYPE
 * @property string $DESCRIPTION
 * @property string $RULE_NAME
 * @property string $DATA
 * @property integer $CREATED_AT
 * @property integer $UPDATED_AT
 *
 * @property AUTHASSIGNMENTDB[] $aUTHASSIGNMENTs
 * @property AUTHRULEDB $rULENAME
 * @property AUTHITEMCHILDDB[] $aUTHITEMChildren
 */
class AUTHITEMDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'AUTH_ITEM';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['NAME'], 'required'],
            [['TYPE', 'CREATED_AT', 'UPDATED_AT'], 'integer'],
            [['NAME', 'RULE_NAME'], 'string', 'max' => 64],
            [['DESCRIPTION', 'DATA'], 'string', 'max' => 4000],
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
            'TYPE' => Yii::t('backend', 'Type'),
            'DESCRIPTION' => Yii::t('backend', 'Description'),
            'RULE_NAME' => Yii::t('backend', 'Rule  Name'),
            'DATA' => Yii::t('backend', 'Data'),
            'CREATED_AT' => Yii::t('backend', 'Created  At'),
            'UPDATED_AT' => Yii::t('backend', 'Updated  At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAUTHASSIGNMENTs()
    {
        return $this->hasMany(AUTHASSIGNMENTDB::className(), ['ITEM_NAME' => 'NAME']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRULENAME()
    {
        return $this->hasOne(AUTHRULEDB::className(), ['NAME' => 'RULE_NAME']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAUTHITEMChildren()
    {
        return $this->hasMany(AUTHITEMCHILDDB::className(), ['CHILD' => 'NAME']);
    }
}
