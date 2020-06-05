<?php

namespace app\core\filters\films;

use app\core\repositories\Films\FilmRepository;
use app\core\repositories\Films\FilmList;
/**
 * Description of PopularFilmsList
 *
 * @author kotov
 */
class PopularFilmsList implements FilmListFilterInterface
{    
    /**
     *
     * @var FilmRepository
     */
    protected $repository;
    
    public function __construct(FilmRepository $repository)
    {
        $this->repository = $repository;
    }
    
    /**
     * @return FilmList[]
     */
    public function getAll()
    {
        $filmsList = $this->repository->getPopularFilms();
        return [new FilmList($filmsList,'Популярные фильмы')];
    }

}
