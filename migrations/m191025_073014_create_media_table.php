<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%media}}`.
 */
class m191025_073014_create_media_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%media}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('Имя файла'),
            'description' => $this->string()->comment('Описание'),
            'path' => $this->string()->comment('Полный путь к файлу'),
            'url' => $this->string()->comment('URL адрес'),
            'mime_type' => $this->string()->comment('MIME type'),
            'size' => $this->bigInteger()->comment('Размер файла'),
            'extension' => $this->string()->comment('Расширение'),
            'media_category_id' => $this->integer()->comment('Категория медиа файла'),
            
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%media}}');
    }
}
