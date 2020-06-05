<?php

use yii\db\Migration;
use yii\db\Schema;


/**
 * Handles the creation of table `person`.
 */
class m181205_061448_create_person_table extends Migration
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
        $this->createTable('{{%person}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('ФИО'),
            'biography' => $this->text()->comment('Биография'),
            'year' => $this->integer()->comment('Год рождения'),
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
        $this->dropTable('{{%person}}');
    }
}
