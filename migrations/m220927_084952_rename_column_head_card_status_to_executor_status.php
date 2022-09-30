<?php

use yii\db\Migration;

/**
 * Class m220927_084952_rename_column_head_card_status_to_executor_status
 */
class m220927_084952_rename_column_head_card_status_to_executor_status extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('users', 'head_card_status', 'executor_status');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220927_084952_rename_column_head_card_status_to_executor_status cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220927_084952_rename_column_head_card_status_to_executor_status cannot be reverted.\n";

        return false;
    }
    */
}
