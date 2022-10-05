<?php
namespace app\models;
use yii\base\Model;

class LoginForm extends Model
{
    public $email;
    public $password;

    private $_user = false;

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'email' => 'EMAIL',
            'password' => 'ПАРОЛЬ'
        ];
    }

    public function rules()
    {
        return [
            [['email', 'password'], 'required'],
            ['email', 'trim'],
            ['email', 'email'],
            ['password', 'validatePassword'],
        ];
    }

    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $_user = $this->getUser();

            if (!$_user || !$_user->validatePassword($this->password)) {
                $this->addError($attribute, 'Неправильный email или пароль.');
            }
        }
    }

    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findOne(['email' => $this->email]);
        }
        return $this->_user;
    }
}
