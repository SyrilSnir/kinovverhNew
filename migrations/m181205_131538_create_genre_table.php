<?php

use yii\db\Migration;

/**
 * Handles the creation of table `genre`.
 */
class m181205_131538_create_genre_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%genre}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('Жанр'),
            'code' => $this->string()->notNull()->comment('Символьный код')
        ]);
        $this->createTable('{{%film_genre}}', [
            'film_id' => $this->integer(),
            'genre_id' => $this->integer(),
            'PRIMARY KEY (film_id,genre_id)'
        ]);
        $this->createIndex(
            'idx-film_genre-film_id',
            '{{%film_genre}}',
            'film_id'
        );
        $this->createIndex(
           'idx-film_genre-genre_id',
           '{{%film_genre}}',
            'genre_id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropIndex(
            'idx-film_genre-film_id',
            '{{%film_genre}}'
        );
        $this->dropIndex(
            'idx-film_genre-genre_id',
            '{{%film_genre}}'
        );        
        $this->dropTable('{{%genre}}');
        $this->dropTable('{{%film_genre}}');
    }
}
