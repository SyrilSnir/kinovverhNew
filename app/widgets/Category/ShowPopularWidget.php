<?php

namespace app\widgets\Category;

use app\core\manage\films\FilmManagerFactory;
use app\core\repositories\Films\FilmRepository;
use yii\base\Widget;


/**
 * Description of ShowPopularWidget
 *
 * @author kotov
 */
class ShowPopularWidget extends Widget
{
    /**
     *
     * @var FilmRepository 
     */    
    public $filmRepository;


    public function __construct( 
            FilmRepository $filmRepository,
            $config = array())
    {
        parent::__construct($config);
        $this->filmRepository = $filmRepository;
    }
    public function run() 
    {
        $filmsManager = FilmManagerFactory::getPopularFilmManager($this->filmRepository);
        
        return $this->render('show',[
            'view' => 'popular',
            'filmLists' => $filmsManager->getList()
        ]);
    }
}
