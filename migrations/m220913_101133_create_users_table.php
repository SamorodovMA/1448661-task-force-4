<?php

use yii\db\Migration;

/**
 * Handles the creation of table '{{%users}}'.
 */
class m220913_101133_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%users}}', [
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->string(255)->notNull(),
            'email' => $this->string(255)->notNull()->unique(),
            'password' => $this->char(64)->notNull(),
            'date_creation' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP')->notNull(),
            'rating' => $this->integer()->unsigned()->defaultValue(0),
            'popularity' => $this->integer()->unsigned()->defaultValue(0),
            'avatar_file_id' => $this->integer()->unsigned(),
            'birthday' => $this->dateTime(),
            'phone' => $this->string(11),
            'telegram' => $this->string(50),
            'bio' => $this->text(),
            'orders_num' => $this->integer()->unsigned()->defaultValue(0),
            'head_card_status' => $this->tinyInteger()->unsigned(),
            'is_executor' => $this->boolean(),
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('{{%users}}', ['id' => 1]);
        $this->dropTable('{{%users}}');
    }
}

