<?php

namespace app\core\manage\films;

use app\core\filters\films\FilmByGenreList;
use app\core\filters\films\PopularFilmsList;
use app\core\filters\films\CategoryList;
use app\models\ActiveRecord\Film\Category;
use app\core\repositories\Films\FilmRepository;
use app\core\manage\films\FilmManager;

/**
 * Description of FilmManagerFactory
 *
 * @author kotov
 */
class FilmManagerFactory
{
    /**
     * 
     * @param FilmRepository $repository
     * @param array $genreList
     * @return FilmManager
     */
    public static function getFilmManagerForGenreList(FilmRepository $repository,array $genreList): FilmManager
    {
       $filmsFilter = new FilmByGenreList($repository, $genreList);
       return new FilmManager($filmsFilter);       
    }

    /**
     * 
     * @param FilmRepository $repository
     * @return FilmManager
     */
    public static function getPopularFilmManager(FilmRepository $repository)
    {
        $filmsFilter = new PopularFilmsList($repository);
        return new FilmManager($filmsFilter);
        
    }
    
    public static function getFilmManagerForCategory(FilmRepository $repository,Category $category)
    {
        $filmsFilter = new CategoryList($repository,$category);
        return new FilmManager($filmsFilter);
    }
    
}
