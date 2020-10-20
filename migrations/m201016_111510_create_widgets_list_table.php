<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%widgets_list}}`.
 */
class m201016_111510_create_widgets_list_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%widgets_list}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->comment('Название'),
            'class_name' => $this->string()->comment('Полное имя класса виджета'),
            'activate' => $this->boolean()->comment('Активен (да/нет)')
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%widgets_list}}');
    }
}
