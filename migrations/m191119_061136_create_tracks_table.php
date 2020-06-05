<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tracks}}`.
 */
class m191119_061136_create_tracks_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tracks}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('Название трека'),
            'track_num' => $this->integer()->comment('Номер трека'),
            'album_id' => $this->integer()->comment('Альбом'),
            'time' => $this->string()->comment('Длительность'),
            'media_id' => $this->integer()->comment('Id аудиоматериала'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%tracks}}');
    }
}
