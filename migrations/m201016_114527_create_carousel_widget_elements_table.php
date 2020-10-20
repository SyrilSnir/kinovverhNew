<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%carousel_widget_elements}}`.
 */
class m201016_114527_create_carousel_widget_elements_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%carousel_widget_elements}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('Заголовок'),
            'image' => $this->string()->notNull()->comment('Изображение'),
            'film_id' => $this->integer()->comment('Фильм'),
            'sort' => $this->integer()->comment('Порядковый носмер')                           
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%carousel_widget_elements}}');
    }
}
