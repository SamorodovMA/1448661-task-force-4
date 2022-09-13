<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%categories}}`.
 */
class m220912_171050_create_categories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%categories}}', [
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->string(128)->unique()->notNull(),
            'icon' => $this->string(20)
        ]);

        $this->insert('categories', [
            'name' => 'Курьерские услуги',
            'icon' => 'courier',
        ]);

        $this->insert('categories', [
            'name' => 'Уборка',
            'icon' => 'clean',
        ]);

        $this->insert('categories', [
            'name' => 'Переезды',
            'icon' => 'cargo',
        ]);

        $this->insert('categories', [
            'name' => 'Компьютерная помощь',
            'icon' => 'neo',
        ]);

        $this->insert('categories', [
            'name' => 'Ремонт квартирный',
            'icon' => 'flat',
        ]);

        $this->insert('categories', [
            'name' => 'Ремонт техники',
            'icon' => 'repair',
        ]);

        $this->insert('categories', [
            'name' => 'Красота',
            'icon' => 'beauty',
        ]);

        $this->insert('categories', [
            'name' => 'Фото',
            'icon' => 'photo',
        ]);
        $this->insert('categories', [
            'name' => 'Переводы',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%categories}}');
    }
}
