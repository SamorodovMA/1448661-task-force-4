<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;


class SignupForm extends Model
{
    public $name;
    public $email;
    public $city_id;
    public $password;
    public $password_repeat;
    public $is_executor;

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Ваше имя',
            'email' => 'Email',
            'password' => 'Пароль',
            'password_repeat' => 'Повтор пароля',
            'is_executor' => ' я собираюсь откликаться на заказы',
            'city_id' => 'Город',
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'password', 'password_repeat', 'city_id'], 'required'],
            ['name', 'trim'],
            ['name', 'string', 'min' => 2, 'max' => 64,],
            ['email', 'trim'],
            ['email', 'email'],
            ['email', 'string', 'max' => 64],
            ['email', 'unique', 'targetClass' => '\app\models\User'],
            ['password', 'string', 'min' => 4, 'max' => 24],
            ['password', 'compare'],
            ['city_id', 'integer'],
            ['is_executor', 'integer']
        ];
    }

    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->city_id = $this->city_id;
        $user->password = Yii::$app->security->generatePasswordHash($this->password);
        $user->is_executor = $this->is_executor;

        return $user->save();
    }

    public function getCities()
    {
        $cities = City::find()
            ->asArray()
            ->all();
        return ArrayHelper::map($cities, 'id', 'name');
    }

}