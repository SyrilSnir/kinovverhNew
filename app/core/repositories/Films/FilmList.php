<?php

namespace app\core\repositories\Films;

use app\models\ActiveRecord\Film;
use yii\base\Model;

/**
 * Description of FilmList
 * @property string $name Нвзвание кагегории
 * @property string $slug Идентификатор
 * @author kotov
 */
class FilmList extends Model
{
    /** @var string Название группы фильмов (категория) */   
    protected $name; 
    /** @var string Код категории (категория) */
    protected $slug; 
    /** @var Film[] */
    protected $films; 
    /** @var string Сообщение при отсутствии фильмов в данной категории */
    protected $filmNotFoundMessage;
    
    public function __construct( 
            array $films,
            $name = '',
            $slug = '',
            $filmNotFoundMessage = 'Отсутствуют фильмы в данной категории')
    {
        parent::__construct();
        $this->name = $name;
        $this->slug = $slug;
        $this->films = $films;
        $this->filmNotFoundMessage = $filmNotFoundMessage;
        
    }
    /**
     * 
     * @return string
     */
    public function getErrorMessage() 
    {
        return $this->filmNotFoundMessage;
    }
    /**
     * Вернуть название категории
     * @return string
     */
    public function getName() 
    {
        return $this->name;
    }
    /**
     * 
     * @return Film[]
     */
    public function getFilms() 
    {
        return $this->films;
    }
    
    public function getSlug()
    {
        return $this->slug;
    }
}
