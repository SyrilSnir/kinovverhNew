<?php

use yii\db\Migration;

/**
 * Handles the creation of table `occupation`.
 */
class m181205_104903_create_occupation_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%occupation}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('Род деятельности')
        ]);
        
        $this->createTable('{{%person_occupation}}', [
            'person_id' => $this->integer(),
            'occupation_id' => $this->integer(),
            'PRIMARY KEY (person_id,occupation_id)'
        ]);
        $this->createIndex(
            'idx-person_occupation-person_id',
            '{{%person_occupation}}',
            'person_id'
        );
        $this->createIndex(
            'idx-person_occupation-occupation_id',
            '{{%person_occupation}}',
            'occupation_id'
        );
        
        $this->createTable('{{%film_person_occupation}}', [
            'film_id' => $this->integer(),
            'person_id' => $this->integer(),
            'occupation_id' => $this->integer(),
            'PRIMARY KEY (film_id,person_id,occupation_id)'
        ]);
        $this->createIndex(
            'idx-film_person_occupation-film_id',
            '{{%film_person_occupation}}',
            'film_id'
        );
        $this->createIndex(
            'idx-film_person_occupation-person_id',
            '{{%film_person_occupation}}',
            'person_id'
        );
        $this->createIndex(
            'idx-film_person_occupation-occupation_id',
            '{{%film_person_occupation}}',
            'occupation_id'
        );
        
        
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropIndex(
            'idx-person_occupation-person_id',
            '{{%person_occupation}}'
        );
        $this->dropIndex(
            'idx-person_occupation-occupation_id',
            '{{%person_occupation}}'
        );
        
        $this->dropIndex(
            'idx-film_person_occupation-film_id',
            '{{%film_person_occupation}}'
        ); 
        $this->dropIndex(
            'idx-film_person_occupation-person_id',
            '{{%film_person_occupation}}'
        );
        $this->dropIndex(
            'idx-film_person_occupation-occupation_id',
            '{{%film_person_occupation}}'
        );
        
        $this->dropTable('{{%occupation}}');
        $this->dropTable('{{%person_occupation}}');
        $this->dropTable('{{%film_person_occupation}}');
    }
}
