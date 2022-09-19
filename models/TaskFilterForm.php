<?php

namespace app\models;

use yii\base\Model;

class TaskFilterForm extends Model
{
    public $categories = [];
    public $executor;
    public $period;

    public function attributeLabels()
    {
        return [
            'categories' => 'Категории',
            'executor' => ' Без исполнителя',
            'period' => ''
        ];

    }



    public static function getPeriodValue ()
    {
        return [
            '1' => '1 час',
            '12' => '12 часов',
            '24' => '24 часа'
        ];
    }
}
