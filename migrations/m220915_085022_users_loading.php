<?php

use yii\db\Migration;

/**
 * Class m220915_085022_users_loading
 */
class m220915_085022_users_loading extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $usersSqlInsert = file_get_contents('./web/data/users.sql');

        $this->execute($usersSqlInsert);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220915_085022_users_loading cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220915_085022_users_loading cannot be reverted.\n";

        return false;
    }
    */
}
