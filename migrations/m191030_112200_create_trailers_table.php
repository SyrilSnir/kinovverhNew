<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%trailers}}`.
 */
class m191030_112200_create_trailers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%trailers}}', [
            'id' => $this->primaryKey(),                
            'film_id' => $this->integer()->notNull(),
            'file_path' => $this->string()->notNull(),
            'url' => $this->string()->notNull(),
            'sort' => $this->integer()
        ]);
        $this->createIndex('{{%idx-trailers-film_id}}', '{{%trailers}}', 'film_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%trailers}}');
    }
}
