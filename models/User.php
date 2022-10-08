<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

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
class User extends ActiveRecord implements IdentityInterface
{

    const STATUS_OPEN = 1;
    const STATUS_BUSY = 2;


    private function getExecutorStatusesList()
    {
        return [
            self::STATUS_OPEN => 'Открыт для новых заказов',
            self::STATUS_BUSY => 'Занят'
        ];
    }

    public function getExecutorStatusName() {
        $statusList = $this->getExecutorStatusesList();
        return $statusList[$this->executor_status];
    }


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
            [['name', 'email', 'password'], 'required'],
            [['date_creation', 'birthday'], 'safe'],
            [['email'], 'unique'],
            [['rating'], 'number'],
            [['popularity', 'avatar_file_id', 'orders_num', 'executor_status', 'is_executor', 'city_id', 'complete', 'refuse'], 'integer'],
            [['bio', 'description'], 'string'],
            [['name', 'email'], 'string', 'max' => 255],
            [['password'], 'string', 'max' => 64],
            [['phone'], 'string', 'max' => 11],
            [['telegram'], 'string', 'max' => 50],
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
            'name' => 'Ваше имя',
            'email' => 'Email',
            'password' => 'Пароль',
            'password_repeat' => 'Повтор пароля',
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
            'is_executor' => ' я собираюсь откликаться на заказы',
            'description' => 'Description',
            'city_id' => 'Город',
        ];
    }

    /**
     * Gets query for [[AvatarFile]].
     *
     * @return ActiveQuery
     */
    public function getAvatarFile()
    {
        return $this->hasOne(File::class, ['id' => 'avatar_file_id']);
    }

    /**
     * Gets query for [[City]].
     *
     * @return ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::class, ['id' => 'city_id']);
    }

    /**
     * Gets query for [[Feedbacks]].
     *
     * @return ActiveQuery
     */
    public function getFeedbacks()
    {
        return $this->hasMany(Feedback::class, ['customer_id' => 'id']);
    }

    /**
     * Gets query for [[Responses]].
     *
     * @return ActiveQuery
     */
    public function getResponses()
    {
        return $this->hasMany(Response::class, ['executor_id' => 'id']);
    }

    /**
     * Gets query for [[Tasks]].
     *
     * @return ActiveQuery
     */
    public function getCustomerTasks()
    {
        return $this->hasMany(Task::class, ['customer_id' => 'id']);
    }

    /**
     * Gets query for [[Tasks0]].
     *
     * @return ActiveQuery
     */
    public function getExecutorTasks()
    {
        return $this->hasMany(Task::class, ['executor_id' => 'id']);
    }

    /**
     * Gets query for [[UserCategories]].
     *
     * @return ActiveQuery
     */
    public function getUserCategories()
    {
        return $this->hasMany(UserCategory::class, ['user_id' => 'id']);
    }

    /**
     * @param $id
     * @return IdentityInterface|null
     */
    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    /**
     * @param $token
     * @param $type
     * @return IdentityInterface|null
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
    }

    /**
     * @return int|string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
    }

    /**
     * @param $authKey
     * @return bool|null
     */
    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }
}
