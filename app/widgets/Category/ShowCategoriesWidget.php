<?php

namespace app\widgets\Category;

use yii\base\Widget;
use app\core\repositories\Films\GenreRepository;
use app\core\repositories\Films\FilmRepository;
use app\core\manage\films\FilmManagerFactory;

/**
 * Description of ShowCategoriesWidget
 *
 * @author kotov
 */
class ShowCategoriesWidget extends Widget
{
    /**
     *
     * @var GenreRepository
     */
    public $genreRepository;
    
    /**
     *
     * @var FilmRepository 
     */    
    public $filmRepository;


    public function __construct(
            GenreRepository $genreRepository, 
            FilmRepository $filmRepository,
            $config = array())
    {
        parent::__construct($config);
        $this->genreRepository = $genreRepository;
        $this->filmRepository = $filmRepository;
    }

    public function run() 
    {
        $genreList = $this->genreRepository->getAll();
        $filmsManager = FilmManagerFactory::getFilmManagerForGenreList($this->filmRepository,$genreList);
        return $this->render('show',[
            'genreList' => $genreList,
            'view' => 'categories',
            'filmLists' => $filmsManager->getList()
        ]);
    }
}
