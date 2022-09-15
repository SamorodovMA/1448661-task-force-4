<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%locations}}`.
 */
class m220913_065725_create_locations_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%locations}}', [
            'id' => $this->primaryKey()->unsigned(),
            'city_id' => $this->integer()->unsigned()->notNull(),
            'latitude' => $this->decimal(11, 8)->notNull(),
            'longitude' => $this->decimal(11, 8)->notNull()
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%locations}}');
    }
}
