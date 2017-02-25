<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "MENU".
 *
 * @property integer $ID
 * @property string $NAME
 * @property integer $PARENT
 * @property string $ROUTE
 * @property integer $PRIORITY
 * @property string $DATA
 *
 * @property MENUDB $pARENT
 * @property MENUDB[] $mENUs
 */
class MENUDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'MENU';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID'], 'required'],
            [['ID', 'PARENT', 'PRIORITY'], 'integer'],
            [['NAME'], 'string', 'max' => 128],
            [['ROUTE', 'DATA'], 'string', 'max' => 256],
            [['ID'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => Yii::t('backend', 'ID'),
            'NAME' => Yii::t('backend', 'Name'),
            'PARENT' => Yii::t('backend', 'Parent'),
            'ROUTE' => Yii::t('backend', 'Route'),
            'PRIORITY' => Yii::t('backend', 'Priority'),
            'DATA' => Yii::t('backend', 'Data'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPARENT()
    {
        return $this->hasOne(MENUDB::className(), ['ID' => 'PARENT']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMENUs()
    {
        return $this->hasMany(MENUDB::className(), ['PARENT' => 'ID']);
    }
}
