<?php

use yii\db\Migration;

/**
 * Class m221011_094122_change_columns_budget_and_period_execution
 */
class m221011_094122_change_columns_budget_and_period_execution extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('tasks', 'budget', $this->integer()->unsigned()->null());
        $this->alterColumn('tasks', 'period_execution', $this->dateTime()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221011_094122_change_columns_budget_and_period_execution cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221011_094122_change_columns_budget_and_period_execution cannot be reverted.\n";

        return false;
    }
    */
}
