<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%albums}}`.
 */
class m191115_121048_create_albums_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%albums}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('Название'),
            'code' => $this->string()->notNull()->comment('Символьный код'),
            'description' => $this->text()->comment('Описание'),          
            'image_path' => $this->string()->comment('Путь к файлу с изображением'),
            'image_url' => $this->string()->comment('Url файла с изображением'),
            'year' => $this->integer(4)->comment('Год выпуска'),
            'created_by' => $this->integer()->comment('Кем создан'),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
            'active' => $this->boolean()->notNull()->defaultValue(true) 
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%albums}}');
    }
}
