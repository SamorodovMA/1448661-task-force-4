<?php

use yii\db\Migration;

/**
 * Class m220929_170359_add_columns_complete_and_refuse
 */
class m220929_170359_add_columns_complete_and_refuse extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('users', 'complete', $this->integer()->unsigned()->defaultValue(0));
        $this->addColumn('users', 'refuse', $this->integer()->unsigned()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220929_170359_add_columns_complete_and_refuse cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220929_170359_add_columns_complete_and_refuse cannot be reverted.\n";

        return false;
    }
    */
}
