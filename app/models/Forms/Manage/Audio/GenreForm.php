<?php

namespace app\models\Forms\Manage\Audio;

use app\models\ActiveRecord\Audio\Genre;
use yii\base\Model;

/**
 * Description of GenreForm
 *
 * @author kotov
 */
class GenreForm extends Model
{
    public $name;
    public $code;
    
    public function __construct(Genre $genre=null, $config = array())
    {
        if ($genre) {
            $this->name = $genre->name;
            $this->code = $genre->code;
        }
        parent::__construct($config);
    }

    public function attributeLabels(): array
    {
        return [
            'name'  => 'Жанр',
            'code' => 'Идентификатор',
        ];
    }

    public function rules(): array 
    {
        return [
            [['name','code'],'string'],
        ];
    }
}
