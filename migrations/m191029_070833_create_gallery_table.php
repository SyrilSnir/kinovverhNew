<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%gallery}}`.
 */
class m191029_070833_create_gallery_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%gallery}}', [
            'id' => $this->primaryKey(),
            'film_id' => $this->integer()->notNull(),
            'file_path' => $this->string()->notNull(),
            'url' => $this->string()->notNull(),
            'sort' => $this->integer()
        ]);
        
        $this->createIndex('{{%idx-gallery-film_id}}', '{{%gallery}}', 'film_id');
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%gallery}}');
    }
}
