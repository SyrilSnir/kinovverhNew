<?php

namespace app\core\filters\films;

use app\core\repositories\Films\FilmRepository;
use app\core\repositories\Films\FilmList;
use app\models\ActiveRecord\Film\Category;
/**
 * 
 * Description of CategoryList
 *
 * @author kotov
 */
class CategoryList implements FilmListFilterInterface
{
    /**
     *
     * @var FilmRepository
     */
    protected $repository;
 
    /**
     * 
     * @var Category
     */
    protected $category;
    
    
    public function __construct(FilmRepository $repository, Category $category)
    {
        $this->category = $category;
        $this->repository = $repository;
    }
    /**
     * @return FilmList[]
     */
    public function getAll() 
    {
       $filmList = $this->repository->getFilmsByCategory($this->category);
       return [ 
           new FilmList(
                   $filmList, 
                   $this->category->name
                   )
           ];      
    }
}
