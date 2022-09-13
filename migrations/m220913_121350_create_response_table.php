<?php

use yii\db\Migration;

/**
 * Handles the creation of table '{{%response}}'.
 */
class m220913_121350_create_response_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%response}}', [
            'id' => $this->primaryKey()->unsigned(),
            'date_creation' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP')->notNull(),
            'task_id' => $this->integer()->unsigned()->notNull(),
            'executor_id' => $this->integer()->unsigned()->notNull(),
            'price' => $this->integer()->unsigned(),
            'comment' => $this->string(255)
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%response}}');
    }
}
