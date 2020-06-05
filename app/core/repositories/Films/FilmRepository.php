<?php

namespace app\core\repositories\Films;

use app\models\ActiveRecord\Film\Category;
use app\models\ActiveRecord\Film\Film;
use app\core\exceptions\NotFoundException;
use app\core\repositories\RepositoryInterface;
use app\core\repositories\DataManipulationTrait;


/**
 * Description of FilmRepository
 *
 * @author kotov
 */
class FilmRepository implements RepositoryInterface
{
   use DataManipulationTrait;
   /**
   * Вернуть фильм по их жанру
   * @string $genre жанр
   * @return Film[]
    */
   public function getFilmsByCategory(Category $category) 
   {
       return $category->getFilms();
   }
   
    /**
    * 
    * @param type $code
    * @return Films
    */
   public function getFilmByCode ($code) {
       if (!$film = Film::findOne(['code' => $code])) {
           throw new NotFoundException('Фильм не найден');
       }
       return $film;
   }
   
    /**
    * Вернуть популярные фильмы
    * @return Film[]
    */
   public function getPopularFilms(int $limit = null) 
   {
        return Film::find()
                ->orderBy('shows')
                ->limit($limit)
                ->all();   
   }

    public static function findById($id)
    {
        return Film::find()
                ->andWhere(['id' => $id])
                ->one();
    }
}
