<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;


class Category extends ActiveRecord
{

    public static function tableName()
    {
        return 'categories';
    }


    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['icon'], 'string', 'max' => 20],
            [['name'], 'unique'],
        ];
    }


    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'icon' => 'Иконка',
        ];
    }

    public function getTask(): ActiveQuery
    {
        return $this->hasMany(Task::class, ['category_id' => 'id'])->inverseOf('category');
    }

    public function getUser(): ActiveQuery
    {
        return $this->hasMany(User::class, ['category_id' => 'id'])->inverseOf('category');
    }
}
