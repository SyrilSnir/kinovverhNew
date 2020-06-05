<?php

namespace app\models\Forms\Manage\Geografy;

use app\models\ActiveRecord\Country;
use yii\base\Model;

/**
 * Description of CountryForm
 *
 * @author kotov
 */
class CountryForm extends Model
{
    public $name;
    public $code;
    
    public function __construct(Country $country=null, $config = array())
    {
        if ($country) {
            $this->name = $country->name;
            $this->code = $country->code;
        }
        parent::__construct($config);
    }

        public function attributeLabels(): array
    {
        return [
          'name'  => 'Название страны',
          'code' => 'Идентификатор',
        ];
    }

    public function rules(): array 
    {
        return [
            ['name','required'],
            ['code','safe'],
        ];
    } 
}
