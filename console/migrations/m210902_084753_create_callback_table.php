<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%callback}}`.
 */
class m210902_084753_create_callback_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%callback}}', [
            'id' => $this->primaryKey(),
            'account' => $this->string(255)->comment('Наименование плательщика'),
            'amount' => $this->integer()->comment('Сумма оплаты в копейках'),
            'date' => $this->dateTime()->comment('Дата оплаты'),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%callback}}');
    }
}
