<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%music_genre}}`.
 */
class m191115_121105_create_music_genre_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%music_genre}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('Жанр'),
            'code' => $this->string()->notNull()->comment('Символьный код')
        ]);
        $this->createTable('{{%album_genre}}', [
            'album_id' => $this->integer(),
            'genre_id' => $this->integer(),
            'PRIMARY KEY (album_id,genre_id)'
        ]);
        $this->createIndex(
            'idx-album_genre-album_id',
            '{{%album_genre}}',
            'album_id'
        );
        $this->createIndex(
           'idx-album_genre-genre_id',
           '{{%album_genre}}',
            'genre_id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex(
            'idx-album_genre-album_id',
            '{{%album_genre}}'
        );
        $this->dropIndex(
            'idx-album_genre-genre_id',
            '{{%album_genre}}'
        ); 
        $this->dropTable('{{%music_genre}}');
        $this->dropTable('{{%album_genre}}');
    }
}
