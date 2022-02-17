<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user
 *
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }
public function attributeLabels()
    {
        return [
            'email' => \Yii::t('app', 'Email'),
            'username' => Yii::t('app','Email'),
            'role_id' => \Yii::t('app', 'User type')
        ];
    }
    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
   
    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    // public function login()
    // {
        
    //         return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        
    //     return false;
    // }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */ public function login()
    {

        
            $user = $this->getUser();
            if ($user) {
                if (! $user->isActive()) {
                    $this->addError('username', 'User is ' . $user->state);
                }elseif (! $user->validatePassword($this->password)) {
                    $this->addError('password', 'Incorrect username or password.');
                }
                if (! $this->hasErrors()) {
                    if ($user->role_id ==User::ROLE_STAFF || $user->role_id == User::ROLE_USER) {
                        LoginHistory::add(true, $user, null);
                        return Yii::$app->user->login($user, $this->rememberMe ? 3600 * 24 * 30 : 0);
                    } else {
                        $this->addError('password', 'you are not authorized user to access this panel.');
                    }
                }
            } else {
                $this->addError('username', 'Incorrect email and check select box');
            }
        
        return false;
    }
     public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword(yii::$app->name . $password, $this->password);
    }
    public function getUser()
    {
        if ($this->_user === false) {

            $this->_user =  User::findByUsername($this->username);
        }

        return $this->_user;
    }

}
