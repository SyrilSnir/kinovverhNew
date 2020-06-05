<?php

namespace app\models\ActiveRecord;

use yii\db\ActiveRecord;

/**
* Description of Country
* @property integer $id
* @property string $name
* @property string $code
* @author kotov
 */
class Country extends ActiveRecord
{
    public static function tableName(): string
    {
        return '{{%country}}';
    }
    
    public static function create($name,$code):self
    {
        $country = new self();
        $country->name = $name;
        $country->code = $code;
        return $country;
    }
    
    public function edit($name,$code) 
    {
        $this->name = $name;
        $this->code = $code;
    }
    
    
}