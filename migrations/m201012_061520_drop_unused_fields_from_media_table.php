<?php

use yii\db\Migration;

/**
 * Handles the dropping of table `{{%unused_fields_from_media}}`.
 */
class m201012_061520_drop_unused_fields_from_media_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%media}}','path');
        $this->dropColumn('{{%media}}','url');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('{{%media}}', 'path', $this->string()->comment('Полный путь к файлу'));
        $this->addColumn('{{%media}}', 'url', $this->string()->comment('URL адрес'));
    }
}
