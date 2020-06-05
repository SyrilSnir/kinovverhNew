<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%media_category}}`.
 */
class m191025_075630_create_media_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%media_category}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('Название категории'),
            'description' => $this->text()->comment('Описание'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%media_category}}');
    }
}
