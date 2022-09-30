<?php

use yii\db\Migration;

/**
 * Class m220929_163539_changing_type_for_rating
 */
class m220929_163539_changing_type_for_rating extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('users', 'rating', $this->decimal(3,2)->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220929_163539_changing_type_for_rating cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220929_163539_changing_type_for_rating cannot be reverted.\n";

        return false;
    }
    */
}
