<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation of table `films`.
 */
class m181130_121159_create_films_table extends Migration
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
        $this->createTable('{{%films}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('Название'),
            'code' => $this->string()->notNull()->comment('Символьный код'),
            'preview_text' => Schema::TYPE_TEXT,
            'detail_text' => Schema::TYPE_TEXT,
            'year' => $this->integer(4)->comment('Год'),
            'time' => $this->integer()->comment('Продожительность'),
            'category_id' => $this->integer()->notNull()->defaultValue(0)->comment('Знак информационной продукции'),
            'country_id' => $this->integer()->notNull()->defaultValue(1)->comment('Страна'),
            'media_id' => $this->integer()->comment('Id видеоматериала'),
            'rating' => $this->float(1)->comment('Рейтинг'),
            'images' => $this->text()->comment('Изображения'),
            'kinopanorama_active' => $this->boolean()->notNull()->defaultValue(0)->comment('Кинопанорама'),
            'kinopanorama_id' => $this->integer()->comment('Id медиафайла кинопанорамы'),
            'shows' => $this->integer()->notNull()->defaultValue(0)->comment('Количество просмотров'),
            'downloads' => $this->integer()->notNull()->defaultValue(0)->comment('Количество скачиваний'),
            'created_by' => Schema::TYPE_INTEGER,
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
            'active' => $this->boolean()->notNull()->defaultValue(true) 
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%films}}');
    }
}
