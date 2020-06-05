<?php

namespace app\core\filters\films;

use app\models\ActiveRecord\Film\Category;
use app\core\exceptions\TypeMissmatchException;
use app\core\exceptions\NotFoundException;
use app\core\repositories\Films\FilmList;
use app\core\repositories\Films\FilmRepository;

/**
 * Description of FilmByGenreList
 *
 * @author kotov
 */
class FilmByGenreList implements FilmListFilterInterface
{
    /**
     *
     * @var Genre[]
     */
    protected $genreList;
    
    /**
     *
     * @var FilmRepository
     */
    protected $repository;


    /**
     * 
     * @param Genre[] $genreList
     * @throws TypeMissmatchException
     */
    public function __construct(FilmRepository $repository,array $genreList)
    {
        foreach ($genreList as $element) {
            if (!$element instanceof Category) {
                throw new TypeMissmatchException();
            }
            $this->genreList[] = $element;
        }
        $this->repository = $repository;
    }

    /**
     * 
     * @return FilmList[]
     * @throws NotFoundException
     */
    public function getAll()
    {
        if (!$this->genreList) {
            throw new NotFoundException();
        }
        foreach ($this->genreList as $genre) {           
            $filmsList = $this->repository->getFilmsByCategory($genre);
            $result[] = new FilmList(
                    $filmsList,
                    $genre->name,
                    $genre->code
                    );                    
        }
        return $result;        
    }

}
