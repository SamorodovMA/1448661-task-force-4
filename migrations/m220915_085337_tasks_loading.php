<?php

use yii\db\Migration;

/**
 * Class m220915_085337_tasks_loading
 */
class m220915_085337_tasks_loading extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
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
        echo "m220915_085337_tasks_loading cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220915_085337_tasks_loading cannot be reverted.\n";

        return false;
    }
    */
}
