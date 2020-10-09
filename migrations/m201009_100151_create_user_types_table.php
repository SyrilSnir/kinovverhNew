<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_type}}`.
 */
class m201009_100151_create_user_types_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_types}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('Название типа пользователя'),
            'slug' => $this->string()->notNull()->comment('Идентификатор типа пользователя'),            
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_type}}');
    }
}
