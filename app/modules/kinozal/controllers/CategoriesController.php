<?php

namespace app\modules\kinozal\controllers;

use yii\web\Controller;
use app\core\repositories\Films\GenreRepository;
use app\core\repositories\Films\CategoriesRepository;
use app\core\repositories\Films\FilmRepository;
use app\core\manage\films\FilmManagerFactory;

/**
 * Description of CategoriesController
 *
 * @author kotov
 */
class CategoriesController extends Controller
{
    /**
     *
     * @var GenreRepository
     */
    protected $genreRepository;   
    
    /**
     *
     * @var FilmRepository
     */
    protected $filmRepository; 
    /**
     *
     * @var CategoriesRepository
     */
    protected $categoriesRepository;
    
    public function __construct(
        $id, 
        $module, 
        CategoriesRepository $categoriesRepository,
        GenreRepository $genreRepository,
        FilmRepository $filmRepository,
        $config = array())
    {
        parent::__construct($id, $module, $config);
        $this->genreRepository = $genreRepository;
        $this->categoriesRepository = $categoriesRepository;
        $this->filmRepository = $filmRepository;
    }
    
    public function actionIndex() 
    {
        return $this->render('index');
    }
    
    public function actionGenre($genreSlug) 
    {
        $category = $this->categoriesRepository->getCategoryByCode($genreSlug);
    /*    $filmsManager = FilmManagerFactory::getFilmManagerForCategory(
                $this->filmRepository,
                $category
                );
     //   dump($category); die;
      */  
        return $this->render('category',[
            'category' => $category
        ]);
    }
}
