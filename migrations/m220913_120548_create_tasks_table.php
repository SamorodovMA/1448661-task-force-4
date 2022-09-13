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

        $this->insert('tasks', [
            'name' => 'Перевести войну и мир на клингонский',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas varius tortor nibh',
            'category_id' => 9,
            'customer_id' => 1,
            'status' => '1',
            'budget' => '3400',
            'city_id' => 1,
            'period_execution' => '2022/10/20'
        ]);
        $this->insert('tasks', [
            'name' => 'Убраться в квартире после вписки',
            'description' => 'Aenean eu enim justo. Vestibulum aliquam hendrerit molestie',
            'category_id' => 2,
            'customer_id' => 2,
            'status' => 1,
            'city_id' => 1,
            'budget' => '4700',

            'period_execution' => '2022/10/20'
        ]);
        $this->insert('tasks', [
            'name' => 'Перевезти груз на новое место',
            'description' => 'Vestibulum aliquam hendrerit molestie',
            'category_id' => 3,
            'customer_id' => 3,
            'status' => 1,
            'budget' => '18750',
            'city_id' => 1,
            'period_execution' => '2022/10/20'
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
