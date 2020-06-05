<?php

namespace app\core\helpers\Films;

/**
 * Description of ShowPopularFilmListHelper
 *
 * @author kotov
 */
class ShowPopularFilmListHelper
{
    /** @var FilmList Список фильмов */
    protected $filmLists;
    
   /**
    * Добавить упорядоченный список фильмов
    * @param FilmList[] $filmList
    * @throws TypeMissmatchException
    */
    public function setFilmList(array $filmLists)
    {
        foreach ($filmLists as $filmList ) {
            if (! $filmList instanceof FilmList) {
                throw new TypeMissmatchException();
            }
            $this->filmLists[] = $filmList;
        }
    }

    public function show()
    {
        if (empty($this->filmLists)) {
            throw new NotFoundException();
        }        
        $result = Yii::$app->view->render('@views/blocks/popular_film_list.php',['filmLists' => $this->filmLists]);
         return $result;
    } 
}
