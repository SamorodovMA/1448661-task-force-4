<?php

use yii\db\Migration;

/**
 * Class m220926_084229_add_column_city_id_to_users_table
 */
class m220926_084229_add_column_city_id_to_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('users', 'city_id', $this->integer()->unsigned());

        $this->addForeignKey(
            'users_city',
            'users',
            'city_id',
            'cities',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220926_084229_add_column_city_id_to_users_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220926_084229_add_column_city_id_to_users_table cannot be reverted.\n";

        return false;
    }
    */
}
