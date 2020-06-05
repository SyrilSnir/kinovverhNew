<?php

namespace app\core\helpers\Films;

use app\core\repositories\Films\FilmList;
use Yii;

/**
 * Description of ShowFilmListHelper
 *
 * @author kotov
 */
class ShowFilmListHelper implements ShowFilmListInterface
{
    /** @var FilmList[] Список фильмов */
    protected $filmLists;
    
    /**
     * Добавить категорию фильмов для вывода
     * @param FilmList $filmList
     */
    public function addFilmList(FilmList $filmList)
    {
        $this->filmLists[] = $filmList;
    }
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
        $result = Yii::$app->view->render('@views/blocks/film_list.php',['filmLists' => $this->filmLists]);
         return $result;
    }
}
