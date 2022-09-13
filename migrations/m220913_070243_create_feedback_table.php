<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%feedback}}`.
 */
class m220913_070243_create_feedback_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%feedback}}', [
            'id' => $this->primaryKey()->unsigned(),
            'customer_id' => $this->integer()->unsigned()->notNull(),
            'task_id' => $this->integer()->unsigned()->notNull(),
            'date_creation' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP')->notNull(),
            'description' => $this->text()->notNull(),
            'rating' => $this->tinyInteger()->unsigned()->notNull()
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%feedback}}');
    }
}
