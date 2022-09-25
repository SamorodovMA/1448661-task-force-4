<?php

use yii\db\Migration;

/**
 * Class m220921_084625_add_column_is_remote
 */
class m220921_084625_add_column_is_remote extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
$this->addColumn('tasks', 'is_remote', $this->tinyInteger()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220921_084625_add_column_is_remote cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220921_084625_add_column_is_remote cannot be reverted.\n";

        return false;
    }
    */
}
