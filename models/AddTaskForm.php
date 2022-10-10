<?php

namespace app\models;

use Throwable;
use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

class AddTaskForm extends Model
{
    public $title;
    public $description;
    public $category_id;
    public $location;
    public $budget;
    public $period_execution;

    /**
     * @var UploadedFile
     */
    public $taskFiles;


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'title' => 'Опишите суть работы',
            'description' => 'Подробности задания',
            'category_id' => 'Категория',
            'location' => 'Локация',
            'budget' => 'Бюджет',
            'period_execution' => 'Срок исполнения',
            'taskFiles' => 'Файлы'
        ];
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['title', 'description', 'category_id', 'period_execution',], 'required'],
            ['title', 'string', 'min' => 10, 'max' => 60],
            ['description', 'string', 'min' => 30, 'max' => 255],
            ['budget', 'integer', 'min' => 1],
            ['category_id', 'integer'],
            [
                'category_id',
                'exist',
                'targetClass' => Category::class,
                'targetAttribute' => ['category_id' => 'id']
            ],
            [['taskFiles'], 'file', 'skipOnEmpty' => true, 'maxFiles' => 0],


        ];
    }

    /**
     * @return array
     */
    public function getCategory(): array
    {
        $category = Category::find()
            ->asArray()
            ->all();
        return ArrayHelper::map($category, 'id', 'name');
    }

    /**
     * @return array
     */
    public function uploadTaskFiles(): array
    {
        $basePath = 'img/task-file/';
        $pathsToTaskFiles = [];

        foreach ($this->taskFiles as $taskFile) {
            $fileName = strtolower(uniqid($taskFile->baseName) . '.' . $taskFile->extension);

            $taskFile->saveAs(Yii::getAlias('@web') . $basePath . $fileName);

            $pathsToTaskFiles[] = '/' . $basePath . $fileName;
        }
        return $pathsToTaskFiles;
    }

    /**
     * @param array $filesPaths
     * @return array
     */
    public function saveTaskFilesPaths(array $filesPaths): array
    {
        $filesPathsId = [];
        foreach ($filesPaths as $filePath) {
            $fileTask = new File();
            $fileTask->path = $filePath;
            $fileTask->save();
            $filesPathsId[] = $fileTask->id;
        }
        return $filesPathsId;
    }

    /**
     * @param int $customer_id
     * @return int|null
     */
    public function saveTask(int $customer_id): int|null
    {
        if (!$this->validate()) {
            return null;
        }

        $task = new Task();

        $task->name = $this->title;
        $task->category_id = $this->category_id;
        $task->customer_id = $customer_id;
        $task->description = $this->description;
        $task->status = Task::STATUS_NEW;
        $task->budget = $this->budget;
        $task->location_id = $this->location;
        $task->period_execution = $this->period_execution;
        $task->save();
        return $task->id;
    }

    /**
     * @return int|string|null
     * @throws Throwable
     */

    public function getCurrentCustomerId(): int|string|null
    {
        if (Yii::$app->user->getIdentity()) {
            return Yii::$app->user->id;
        }
        return null;
    }

    /**
     * @param int $currentTaskId
     * @param array $filesPathsId
     * @return void
     */

    public function saveTaskFiles(int $currentTaskId, array $filesPathsId)
    {
        foreach ($filesPathsId as $pathId) {
            $taskFiles = new TaskFile();
            $taskFiles->task_id = $currentTaskId;
            $taskFiles->file_id = $pathId;
            $taskFiles->save();
        }
    }

}