<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "AUTH_ASSIGNMENT".
 *
 * @property string $ITEM_NAME
 * @property string $USER_ID
 * @property integer $CREATED_AT
 *
 * @property AUTHITEMDB $iTEMNAME
 */
class AUTHASSIGNMENTDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'AUTH_ASSIGNMENT';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ITEM_NAME', 'USER_ID'], 'required'],
            [['CREATED_AT'], 'integer'],
            [['ITEM_NAME', 'USER_ID'], 'string', 'max' => 64],
            [['ITEM_NAME', 'USER_ID'], 'unique', 'targetAttribute' => ['ITEM_NAME', 'USER_ID'], 'message' => 'The combination of Item  Name and User  ID has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ITEM_NAME' => Yii::t('backend', 'Item  Name'),
            'USER_ID' => Yii::t('backend', 'User  ID'),
            'CREATED_AT' => Yii::t('backend', 'Created  At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getITEMNAME()
    {
        return $this->hasOne(AUTHITEMDB::className(), ['NAME' => 'ITEM_NAME']);
    }
}
