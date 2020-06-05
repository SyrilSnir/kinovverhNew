<?php

use yii\db\Migration;

/**
 * Handles the creation of table `films_comment`.
 */
class m181211_144659_create_film_comment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%film_comment}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull()->defaultValue(-1)->comment('Id пользователя (для гостей равнро -1)'),
            'user_name' => $this->string()->comment('Имя пользователя (для гостей)'),
            'film_id' => $this->integer()->notNull(),
            'message' => $this->text(),
            'moderate' => $this->boolean()->notNull()->defaultValue(false)->comment('Прошло модерацию'),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),        
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%film_comment}}');
    }
}
