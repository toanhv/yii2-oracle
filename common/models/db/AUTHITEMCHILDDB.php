<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "AUTH_ITEM_CHILD".
 *
 * @property string $PARENT
 * @property string $CHILD
 *
 * @property AUTHITEMDB $pARENT
 * @property AUTHITEMDB $cHILD
 */
class AUTHITEMCHILDDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'AUTH_ITEM_CHILD';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PARENT', 'CHILD'], 'required'],
            [['PARENT', 'CHILD'], 'string', 'max' => 64],
            [['PARENT', 'CHILD'], 'unique', 'targetAttribute' => ['PARENT', 'CHILD'], 'message' => 'The combination of Parent and Child has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PARENT' => Yii::t('backend', 'Parent'),
            'CHILD' => Yii::t('backend', 'Child'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPARENT()
    {
        return $this->hasOne(AUTHITEMDB::className(), ['NAME' => 'PARENT']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCHILD()
    {
        return $this->hasOne(AUTHITEMDB::className(), ['NAME' => 'CHILD']);
    }
}
