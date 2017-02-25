<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\web\IdentityInterface;

class User extends USERADBase implements IdentityInterface {

    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;

    public $re_password;
    public $password_old;

    public function behaviors() {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'CREATED_AT',
                'updatedAtAttribute' => 'UPDATED_AT',
                'value' => new Expression('sysdate'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['USERNAME', 'PASSWORD_HASH', 'EMAIL', 're_password'], 'required'],
            [['USERNAME', 'EMAIL', 'PASSWORD_HASH', 're_password', 'password_old'], 'trim'],
            [['STATUS', 'IS_FIRST_LOGIN'], 'integer'],
            [['CREATED_AT', 'UPDATED_AT'], 'safe'],
            [['USERNAME', 'PASSWORD_HASH', 'PASSWORD_RESET_TOKEN', 'EMAIL'], 'string', 'max' => 255],
            [['AUTH_KEY'], 'string', 'max' => 32],
            [['PASSWORD_HASH', 're_password'], 'string', 'max' => 20, 'min' => 8],
            ['STATUS', 'default', 'value' => self::STATUS_ACTIVE],
            ['STATUS', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
            [['EMAIL'], 'email'],
            [['USERNAME', 'EMAIL'], 'unique'],
            //[['re_password'], 'compare', 'compareAttribute' => 'PASSWORD_HASH', 'message' => Yii::t('backend', 'Mật khẩu gõ lại chưa đúng')],
            [['re_password'], 'validateRePassword'],
            [['PASSWORD_HASH'], 'match', 'pattern' => '((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%]).{8,20})',
                'message' => Yii::t('backend', 'Mật khẩu phải từ 8-20 ký tự và bao gồm chữ thường, chữ HOA, số và ký tự đặc biệt')],
        ];
    }

    public function validateRePassword($attribute, $params) {
        if (!$this->hasErrors()) {
            if (!$this->re_password || $this->re_password != $this->PASSWORD_HASH) {
                $this->addError('re_password', 'Mật khẩu gõ lại chưa đúng!');
            }
        }
    }

    public function validateLength($attribute, $params) {
        if (!$this->hasErrors()) {
            $length = mb_strlen($value, $this->encoding);

            if ($this->min !== null && $length < $this->min) {
                $this->addError($model, $attribute, $this->tooShort, ['min' => $this->min]);
            }
            if ($this->max !== null && $length > $this->max) {
                $this->addError($model, $attribute, $this->tooLong, ['max' => $this->max]);
            }
            if ($this->length !== null && $length !== $this->length) {
                $this->addError($model, $attribute, $this->notEqual, ['length' => $this->length]);
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'ID' => Yii::t('backend', 'ID'),
            'USERNAME' => Yii::t('backend', 'Username'),
            'AUTH_KEY' => Yii::t('backend', 'Auth  Key'),
            'PASSWORD_HASH' => Yii::t('backend', 'Password'),
            'PASSWORD_RESET_TOKEN' => Yii::t('backend', 'Password  Reset  Token'),
            'EMAIL' => Yii::t('backend', 'Email'),
            'STATUS' => Yii::t('backend', 'Kích hoạt'),
            'CREATED_AT' => Yii::t('backend', 'Tạo lúc'),
            'UPDATED_AT' => Yii::t('backend', 'Sửa lúc'),
            'LAST_TIME_LOGIN' => Yii::t('backend', 'Last  Time  Login'),
            'NUM_LOGIN_FAIL' => Yii::t('backend', 'Num  Login  Fail'),
            're_password' => Yii::t('backend', 'Gõ lại mật khẩu'),
        ];
    }

    /**
     * @return bool
     */
    public function beforeSave($insert = true) {
        if ($this->PASSWORD_HASH) {
            $this->setPassword($this->PASSWORD_HASH);
            $this->generateAuthKey();
            $this->generatePasswordResetToken();
        }
        if (!$this->isNewRecord) {
            $insert = false;
            $this->UPDATED_AT = new Expression('sysdate');
        } else {
            $this->NUM_LOGIN_FAIL = 0;
            $this->CREATED_AT = new Expression('sysdate');
            $this->UPDATED_AT = new Expression('sysdate');
        }

        return parent::beforeSave($insert);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id) {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null) {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username) {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token) {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
                    'password_reset_token' => $token,
                    'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token) {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId() {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey() {
        return $this->AUTH_KEY;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey) {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password) {
        return Yii::$app->security->validatePassword($password, $this->PASSWORD_HASH);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password) {
        $this->PASSWORD_HASH = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey() {
        $this->AUTH_KEY = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken() {
        $this->PASSWORD_RESET_TOKEN = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken() {
        $this->PASSWORD_RESET_TOKEN = null;
    }

}
