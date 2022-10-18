<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "response".
 *
 * @property int $id
 * @property string $date_creation
 * @property int $task_id
 * @property int $executor_id
 * @property int|null $price
 * @property string|null $comment
 *
 * @property User $executor
 * @property Task $task
 */
class Response extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'response';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_creation'], 'safe'],
            [['task_id', 'executor_id'], 'required'],
            [['task_id', 'executor_id', 'price'], 'integer'],
            [['comment'], 'string', 'max' => 255],
            [['executor_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['executor_id' => 'id']],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Task::class, 'targetAttribute' => ['task_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date_creation' => 'Date Creation',
            'task_id' => 'Task ID',
            'executor_id' => 'Executor ID',
            'price' => 'Price',
            'comment' => 'Comment',
        ];
    }

    /**
     * Gets query for [[Executor]].
     *
     * @return ActiveQuery
     */
    public function getExecutor()
    {
        return $this->hasOne(User::class, ['id' => 'executor_id']);
    }

    /**
     * Gets query for [[Task]].
     *
     * @return ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Task::class, ['id' => 'task_id']);
    }
}
