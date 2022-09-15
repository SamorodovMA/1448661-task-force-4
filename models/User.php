<?php

namespace app\models;

use yii\db\ActiveRecord;

class User extends ActiveRecord
{

    public static function tableName()
    {
        return 'users';
    }


    public function rules()
    {
        return [
            [['name', 'email', 'password'], 'required'],
            [['name', 'email', 'phone' ,'password'], 'safe'],
            [['category_id', 'rating', 'popularity', 'avatar_file_id', 'orders_num', 'user_status', 'is_executor'], 'integer'],
            [['bio'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['email'], 'string', 'max' => 128],
            [['password'], 'string', 'max' => 64],
            [['phone'], 'string', 'max' => 11],
            [['telegram'], 'string', 'max' => 50],
            [['email'], 'unique'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
            [['avatar_file_id'], 'exist', 'skipOnError' => true, 'targetClass' => File::class, 'targetAttribute' => ['avatar_file_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'date_creation' => 'Date Creation',
            'category_id' => 'Category ID',
            'rating' => 'Rating',
            'popularity' => 'Popularity',
            'avatar_file_id' => 'Avatar File ID',
            'birthday' => 'Birthday',
            'phone' => 'Phone',
            'telegram' => 'Telegram',
            'bio' => 'Bio',
            'orders_num' => 'Orders Num',
            'user_status' => 'User Status',
            'is_executor' => 'Is Executor',
        ];
    }

    /**
     * Gets query for [[AvatarFile]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAvatarFile()
    {
        return $this->hasOne(File::class, ['id' => 'avatar_file_id']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    /**
     * Gets query for [[Feedbacks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFeedbacks()
    {
        return $this->hasMany(Feedback::class, ['customer_id' => 'id']);
    }

    /**
     * Gets query for [[Responses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResponses()
    {
        return $this->hasMany(Response::class, ['executor_id' => 'id']);
    }

    /**
     * Gets query for [[Tasks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Task::class, ['customer_id' => 'id']);
    }

    /**
     * Gets query for [[Tasks0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTasks0()
    {
        return $this->hasMany(Task::class, ['executor_id' => 'id']);
    }
}
