<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "USER_AD".
 *
 * @property integer $ID
 * @property string $USERNAME
 * @property string $AUTH_KEY
 * @property string $PASSWORD_HASH
 * @property string $PASSWORD_RESET_TOKEN
 * @property string $EMAIL
 * @property integer $STATUS
 * @property string $CREATED_AT
 * @property string $UPDATED_AT
 * @property string $LAST_TIME_LOGIN
 * @property integer $NUM_LOGIN_FAIL
 * @property integer $IS_FIRST_LOGIN
 */
class USERADDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'USER_AD';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID'], 'required'],
            [['ID', 'STATUS', 'NUM_LOGIN_FAIL', 'IS_FIRST_LOGIN'], 'integer'],
            [['CREATED_AT', 'UPDATED_AT'], 'safe'],
            [['USERNAME', 'PASSWORD_HASH', 'PASSWORD_RESET_TOKEN', 'EMAIL'], 'string', 'max' => 255],
            [['AUTH_KEY'], 'string', 'max' => 32],
            [['LAST_TIME_LOGIN'], 'string', 'max' => 7],
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
            'USERNAME' => Yii::t('backend', 'Username'),
            'AUTH_KEY' => Yii::t('backend', 'Auth  Key'),
            'PASSWORD_HASH' => Yii::t('backend', 'Password  Hash'),
            'PASSWORD_RESET_TOKEN' => Yii::t('backend', 'Password  Reset  Token'),
            'EMAIL' => Yii::t('backend', 'Email'),
            'STATUS' => Yii::t('backend', 'Status'),
            'CREATED_AT' => Yii::t('backend', 'Created  At'),
            'UPDATED_AT' => Yii::t('backend', 'Updated  At'),
            'LAST_TIME_LOGIN' => Yii::t('backend', 'Last  Time  Login'),
            'NUM_LOGIN_FAIL' => Yii::t('backend', 'Num  Login  Fail'),
            'IS_FIRST_LOGIN' => Yii::t('backend', 'Is  First  Login'),
        ];
    }
}
