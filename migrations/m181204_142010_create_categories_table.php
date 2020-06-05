<?php

use yii\db\Migration;

/**
 * Handles the creation of table `znak`.
 */
class m181204_142010_create_categories_table extends Migration
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
        $this->createTable('{{%categories}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('Текстовое обозначение знака информационной продукции'),
            'code' => $this->string()->notNull()->comment('Символьный код')
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%categories}}');
    }
}
