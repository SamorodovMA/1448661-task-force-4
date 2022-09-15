<?php

use yii\db\Migration;

/**
 * Class m220915_083318_categories_loading
 */
class m220915_083318_categories_loading extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $categoriesSqlInsert = file_get_contents('./web/data/categories.sql');

        $this->execute($categoriesSqlInsert);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220915_083318_categories_loading cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220915_083318_categories_loading cannot be reverted.\n";

        return false;
    }
    */
}
