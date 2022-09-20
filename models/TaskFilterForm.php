<?php

namespace app\models;

use yii\base\Model;

class TaskFilterForm extends Model
{
    public  $categories;
    public  $withoutResponses;
    public  $remoteWork;
    public $period;

    public function attributeLabels()
    {
        return [
            'categories' => 'Категории',
            'withoutResponses' => 'Без откликов',
            'remoteWork'=> 'Удалённая работа',
            'period' => 'Период'
        ];

    }

    public function rules()
    {
        return [
            [['categories', 'withoutResponses', 'remoteWork', 'period'], 'safe']
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
