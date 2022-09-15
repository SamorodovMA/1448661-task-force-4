<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%task_files}}`.
 */
class m220913_100635_create_task_files_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%task_files}}', [
            'id' => $this->primaryKey()->unsigned(),
            'task_id' => $this->integer()->unsigned()->notNull(),
            'file_id' => $this->integer()->unsigned()->notNull()
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%task_files}}');
    }
}
