<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%favorites_films}}`.
 */
class m191112_073303_create_favorites_films_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%favorites_films}}', [
            'user_id' => $this->integer()->notNull()->comment('Id пользователя'),
            'film_id' => $this->integer()->notNull()->comment('Id фильма'),
            'PRIMARY KEY (user_id,film_id)'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%favorites_films}}');
    }
}
