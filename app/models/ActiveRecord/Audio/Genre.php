<?php

namespace app\models\ActiveRecord\Audio;

use app\core\tools\Strings;
use yii\db\ActiveRecord;

/**
 * Description of MusicGenre
 * @property integer $id
 * @property string $name
 * @property string $code
 * @author kotov
 */
class Genre extends ActiveRecord
{
    
    public static function tableName(): string
    {
        return '{{%music_genre}}';
    }

    public function beforeSave($insert) {
        if (empty($this->code)) {
            $this->code = strtolower(Strings::getTransliterateString($this->name));
        }
        return parent::beforeSave($insert);
    }
    
    public static function create($name,$code):self
    {
        $genre = new self();
        $genre->name = $name;
        $genre->code = $code;
        return $genre;
    }
    
    public function edit($name,$code) 
    {
        $this->name = $name;
        $this->code = $code;
    }
}
