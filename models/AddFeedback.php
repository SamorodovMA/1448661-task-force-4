<?php

namespace app\models;

use yii\base\Model;

class AddFeedback extends Model
{
    public $comment;
    public $rating;

    public function attributeLabels()
    {
        return [
            'comment' => 'Ваш комментарий',
            'rating' => 'Рейтинг',
        ];
    }


    public function rules(): array
    {
        return [
            [['comment', 'rating'], 'required'],
            [['comment', 'rating'], 'safe'],
            ['rating', 'integer', 'min' => 1, 'max' => 5],
        ];
    }

    public function saveFeedback($customerId, $taskId) {
        if (!$this->validate()) {
            return null;
        }

        $feedBack = new Feedback();
        $feedBack->customer_id = $customerId;
        $feedBack->task_id = $taskId;
        $feedBack->description = $this->comment;
        $feedBack->rating = $this->rating;
        return $feedBack->save();
    }


}