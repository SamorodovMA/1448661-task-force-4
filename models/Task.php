<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;



class Task extends ActiveRecord
{
    const STATUS_NEW = 1;
    const STATUS_CANCELLED = 2;
    const STATUS_WORKING = 3;
    const STATUS_DONE = 4;
    const STATUS_FAILED = 5;

    public static function tableName()
    {
        return 'tasks';
    }


    public function rules()
    {
        return [
            [['name', 'category_id', 'customer_id', 'status', 'budget', 'period_execution', 'task_statuses_id', 'city_id', 'location_id'], 'required'],
            [['description'], 'string'],
            [['date_creation', 'period_execution'], 'safe'],
            [['category_id', 'customer_id', 'executor_id', 'status', 'budget', 'task_statuses_id', 'city_id', 'location_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['customer_id' => 'id']],
            [['executor_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['executor_id' => 'id']],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::class, 'targetAttribute' => ['city_id' => 'id']],
            [['location_id'], 'exist', 'skipOnError' => true, 'targetClass' => Location::class, 'targetAttribute' => ['location_id' => 'id']],
        ];
    }


    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'description' => 'Описание',
            'date_creation' => 'Дата создания',
            'category_id' => 'Категория',
            'customer_id' => 'Заказчик',
            'executor_id' => 'Исполнитель',
            'status' => 'Статус',
            'budget' => 'Цена',
            'period_execution' => 'Период выполнения',
            'city_id' => 'Город',
            'location_id' => 'Локация',
        ];
    }


    public function getCategory(): ActiveQuery
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }


    public function getCity(): ActiveQuery
    {
        return $this->hasOne(City::class, ['id' => 'city_id']);
    }


    public function getCustomer(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'customer_id']);
    }


    public function getExecutor(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'executor_id']);
    }


    public function getFeedbacks(): ActiveQuery
    {
        return $this->hasMany(Feedback::class, ['task_id' => 'id'])->inverseOf('task');
    }


    public function getLocation(): ActiveQuery
    {
        return $this->hasOne(Location::class, ['id' => 'location_id']);
    }


    public function getResponses(): ActiveQuery
    {
        return $this->hasMany(Response::class, ['task_id' => 'id'])->inverseOf('task');
    }


    public function getTaskFiles(): ActiveQuery
    {
        return $this->hasMany(TaskFile::class, ['task_id' => 'id'])->inverseOf('task');
    }
}
