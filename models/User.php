<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $date_creation
 * @property int|null $rating
 * @property int|null $popularity
 * @property int|null $avatar_file_id
 * @property string|null $birthday
 * @property string|null $phone
 * @property string|null $telegram
 * @property string|null $bio
 * @property int|null $orders_num
 * @property int|null $executor_status
 * @property int|null $is_executor
 * @property string|null $description
 * @property int|null $city_id
 *
 * @property File $avatarFile
 * @property City $city
 * @property Feedback[] $feedbacks
 * @property Response[] $responses
 * @property Task[] $tasks
 * @property Task[] $tasks0
 * @property UserCategory[] $userCategories
 */
class User extends \yii\db\ActiveRecord
{
    const STATUS_OPEN = 1;
    const STATUS_BUSY = 2;

    private function getExecutorStatusesList() {
        return [
            self::STATUS_OPEN => 'Открыт для новых заказов',
            self::STATUS_BUSY => 'Занят'
        ];
    }

    public function getExecutorStatusName() {
        $statusList = $this->getExecutorStatusesList();
        return $statusList[$this->executor_status];
    }

    public $password_repeat;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'password', 'password_repeat', 'city_id'], 'required'],
            [['date_creation', 'birthday'], 'safe'],
            [['rating', 'popularity', 'avatar_file_id', 'orders_num', 'executor_status', 'is_executor', 'city_id'], 'integer'],
            [['bio', 'description'], 'string'],
            [['name', 'email'], 'string', 'max' => 255],
            [['password'], 'string', 'max' => 64],
            [['phone'], 'string', 'max' => 11],
            [['telegram'], 'string', 'max' => 50],
            [['email'], 'unique'],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::class, 'targetAttribute' => ['city_id' => 'id']],
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
            'password_repeat' => 'password_repeat',
            'date_creation' => 'Date Creation',
            'rating' => 'Rating',
            'popularity' => 'Popularity',
            'avatar_file_id' => 'Avatar File ID',
            'birthday' => 'Birthday',
            'phone' => 'Phone',
            'telegram' => 'Telegram',
            'bio' => 'Bio',
            'orders_num' => 'Orders Num',
            'executor_status' => 'Head Card Status',
            'is_executor' => 'Is Executor',
            'description' => 'Description',
            'city_id' => 'City ID',
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
     * Gets query for [[City]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::class, ['id' => 'city_id']);
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
    public function getTasksExecutor()
    {
        return $this->hasMany(Task::class, ['executor_id' => 'id']);
    }

    /**
     * Gets query for [[UserCategories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserCategories()
    {
        return $this->hasMany(UserCategory::class, ['user_id' => 'id']);
    }
}
