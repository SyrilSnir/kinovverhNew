<?php

namespace app\models\ActiveRecord\Film;

use app\core\tools\Strings;


/**
 * Description of Genre
 * @property Films[] $films
 * @author kotov
 */
class Genre extends Category
{    
    public function beforeSave($insert) {
        if (empty($this->code)) {
            $this->code = strtolower(Strings::getTransliterateString($this->name));
        }
        return parent::beforeSave($insert);
    }
    public function getFilms() 
    {
        $junctionTableName = '{{%film_genre}}'; // промежуточная связующая таблица
        return $this->hasMany(Film::class,['id' => 'film_id'])
                ->viaTable($junctionTableName, ['genre_id' => 'id'])
             //   ->asArray()
                ->all();
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
