<?php

namespace app\models;

use yii\base\Model;

class AddResponse extends Model
{
    public $comment;
    public $price;

    public function attributeLabels()
    {
        return [
            'comment' => 'Ваш комментарий',
            'price' => 'Стоимость',
        ];
    }


    public function rules(): array
    {
        return [
            [['comment', 'price'], 'required'],
            [['comment', 'price'], 'safe'],
            ['price', 'integer', 'min' => 1],
            ['comment', 'string', 'min' => 10, ],

        ];
    }

    public function saveResponse($executorId, $taskId) {
        if (!$this->validate()) {
            return null;
        }
        $response = new Response();
        $response->task_id = $taskId;
        $response->executor_id = $executorId;
        $response->price = $this->price;
        $response->comment = $this->comment;
        return $response->save();
    }

public function getCurrentExecutorId()
{
   if (\Yii::$app->user->identity) {
       return \Yii::$app->user->id;
   }
   return null;
}

}