<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%album_singers}}`.
 */
class m201021_100716_create_album_singers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%album_singers}}', [
            'id' => $this->primaryKey(),
            'album_id' => $this->integer(),
            'person_id' => $this->integer(),            
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%album_singers}}');
    }
}
