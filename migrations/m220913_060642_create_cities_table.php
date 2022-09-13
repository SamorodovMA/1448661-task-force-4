<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cities}}`.
 */
class m220913_060642_create_cities_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%cities}}', [
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->string(255)->notNull(),
            'latitude' => $this->decimal(11, 8)->notNull(),
            'longitude' => $this->decimal(11, 8)->notNull()
        ]);

        $this->insert('cities', [
            'name' => 'Санкт-Петербург',
            'latitude' => '59.9386300',
            'longitude' => '30.3141300',
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%cities}}');
    }
}
