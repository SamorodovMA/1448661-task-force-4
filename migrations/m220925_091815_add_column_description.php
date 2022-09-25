<?php

use yii\db\Migration;

/**
 * Class m220925_091815_add_column_description
 */
class m220925_091815_add_column_description extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('users', 'description', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220925_091815_add_column_description cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220925_091815_add_column_description cannot be reverted.\n";

        return false;
    }
    */
}
