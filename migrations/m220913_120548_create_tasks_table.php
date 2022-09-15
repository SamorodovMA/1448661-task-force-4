<?php

use yii\db\Migration;

/**
 * Handles the creation of table '{{%tasks}}'.
 */
class m220913_120548_create_tasks_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tasks}}', [
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->string(255)->notNull(),
            'description' => $this->text(),
            'date_creation' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'category_id' => $this->integer()->unsigned()->notNull(),
            'customer_id' => $this->integer()->unsigned()->notNull(),
            'executor_id' => $this->integer()->unsigned(),
            'status' => $this->tinyInteger()->unsigned()->notNull(),
            'budget' => $this->integer()->unsigned()->notNull(),
            'period_execution' => $this->dateTime()->notNull(),
            'city_id' => $this->integer()->unsigned(),
            'location_id' => $this->integer()->unsigned()
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%tasks}}');
    }
}
