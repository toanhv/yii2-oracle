<?php

namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model {

    public $username;
    public $password;
    public $captcha;
    public $rememberMe = true;
    private $_user;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            // username and password are both required
            [['username', 'password', 'captcha'], 'required'],
            [['username', 'captcha'], 'trim'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
            ['captcha', 'captcha'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params) {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if ($user) {
                if ($user->STATUS == \common\models\User::STATUS_ACTIVE) {
                    if ($user && $user->NUM_LOGIN_FAIL >= 5) {
                        $timeInfo = \Yii::$app->db->createCommand("select SYSDATE - (last_time_login + INTERVAL '10' MINUTE) as TIME_LOGIN from user_ad where id=:id", [
                                    'id' => intval($user->ID)
                                ])->queryOne();
                        if ($timeInfo) {
                            if ($timeInfo['TIME_LOGIN'] < 0) {
                                $this->addError($attribute, 'Đăng nhập sai quá 5 lần. Tài khoản tạm thời bị khóa 10 phút.');
                            } else {
                                self::lockUser($user);
                                if (!$user->validatePassword($this->password)) {
                                    $this->addError($attribute, 'username hoặc password không đúng');
                                }
                            }
                        } else {
                            if (!$user->validatePassword($this->password)) {
                                $this->addError($attribute, 'username hoặc password không đúng');
                            }
                        }
                    } elseif (!$user || !$user->validatePassword($this->password)) {
                        self::lockUser($user);
                        $this->addError($attribute, 'username hoặc password không đúng');
                    }
                } else {
                    $this->addError($attribute, 'Tài khoản của bạn đang bị khóa.');
                }
            } else {
                $this->addError($attribute, 'username hoặc password không đúng');
            }
        }
    }

    public static function lockUser($user) {
        if ($user) {
            $timeInfo = \Yii::$app->db->createCommand("select SYSDATE - (last_time_login + INTERVAL '10' MINUTE) as TIME_LOGIN from user_ad where id=:id", [
                        'id' => intval($user->ID)
                    ])->queryOne();
            if ($timeInfo) {
                if ($timeInfo['TIME_LOGIN'] < 0) {
                    \Yii::$app->db->createCommand("update user_ad set updated_at = sysdate, last_time_login = sysdate, num_login_fail = num_login_fail + 1 where id=:id", [
                        'id' => intval($user->ID)
                    ])->execute();
                } else {
                    \Yii::$app->db->createCommand("update user_ad set updated_at = sysdate, last_time_login = sysdate, num_login_fail = 1 where id=:id", [
                        'id' => intval($user->ID)
                    ])->execute();
                }
            } else {
                \Yii::$app->db->createCommand("update user_ad set updated_at = sysdate, last_time_login = sysdate, num_login_fail = 1 where id=:id", [
                    'id' => intval($user->ID)
                ])->execute();
            }
        }
    }

//    public function validatePassword($attribute, $params) {
//        if (!$this->hasErrors()) {
//            $user = $this->getUser();
//            if ($this->username == 'admin') {
//                if (!$user || !$user->validatePassword($this->password)) {
//                    $this->addError($attribute, 'Incorrect username or password.');
//                }
//            } else {
//                $code = \backend\components\common\VtClientService::validateVSA($this->username, $this->password);
//                if (!$user || intval($code['errorCode']) || strtolower($code['returnCode'] == 'no')) {
//                    $this->addError($attribute, 'Incorrect username or password.');
//                }
//            }
//        }
//    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login() {
        if ($this->validate()) {
            $user = $this->getUser();
            \Yii::$app->db->createCommand("update user_ad set last_time_login = sysdate, num_login_fail = 0 where id=:id", [
                'id'
                => intval($user->ID)
            ])->execute();
            return Yii::$app->user->login($user, $this->rememberMe ? 3600 : 0);
        } else {
            return false;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser() {
        if ($this->_user === null) {
            $this->_user = User::find()->where(['USERNAME' => $this->username])->one();
        }
        return $this->_user;
    }

}
