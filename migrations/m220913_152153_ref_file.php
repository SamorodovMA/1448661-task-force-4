<?php

use yii\db\Migration;

/**
 * Class m220913_152153_ref_file
 */
class m220913_152153_ref_file extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'locations_to_cities',
            'locations',
            'city_id',
            'cities',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'feedback_to_users',
            'feedback',
            'customer_id',
            'users',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'feedback_to_tasks',
            'feedback',
            'task_id',
            'tasks',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'task_files_to_tasks',
            'task_files',
            'task_id',
            'tasks',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'task_files_to_files',
            'task_files',
            'file_id',
            'files',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'users_to_files',
            'users',
            'avatar_file_id',
            'files',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'tasks_to_categories',
            'tasks',
            'category_id',
            'categories',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'tasks_to_customer',
            'tasks',
            'customer_id,',
            'users',
            'id',
            'CASCADE');

        $this->addForeignKey(
            'tasks_to_executor',
            'tasks',
            'executor_id',
            'users',
            'id',
            'CASCADE');

        $this->addForeignKey(
            'tasks_to_cities',
            'tasks',
            'city_id',
            'cities',
            'id',
            'CASCADE');

        $this->addForeignKey(
            'tasks_to_locations',
            'tasks',
            'location_id',
            'locations',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'response_to_tasks',
            'response',
            'task_id',
            'tasks',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'response_to_executor',
            'response',
            'executor_id',
            'users',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'user_categories_to_users',
            'user_categories',
            'user_id',
            'users',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'user_categories_to_categories',
            'user_categories',
            'category_id',
            'categories',
            'id',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220913_152153_ref_file cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220913_152153_ref_file cannot be reverted.\n";

        return false;
    }
    */
}
