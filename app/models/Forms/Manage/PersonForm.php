<?php

namespace app\models\Forms\Manage;

use yii\base\Model;
use app\models\ActiveRecord\Person;

/**
 * Description of PersonForm
 *
 * @author kotov
 */
class PersonForm extends Model
{
    public $name;
    public $year;
    
    public function __construct(Person $person = null, $config = array())
    {
        if ($person) {
            $this->name = $person->name;
            $this->year = $person->year;
        }
        parent::__construct($config);
    }
    
    public function attributeLabels(): array
    {
        return [
          'name'  => 'ФИО',
          'year' => 'Год рождения',
        ];
    }

    public function rules(): array 
    {
        return [
            ['name','required'],
            ['year','safe'],
        ];
    } 
}
