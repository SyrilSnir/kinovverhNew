<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%country}}`.
 */
class m190913_072358_create_country_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%country}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('Название страны'),
            'code' => $this->string(4)->comment('Краткий идентификатор'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%country}}');
    }
}
