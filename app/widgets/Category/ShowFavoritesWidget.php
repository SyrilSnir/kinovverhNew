<?php

namespace app\widgets\Category;

use app\core\manage\films\FilmManagerFactory;
use app\core\repositories\Films\FilmRepository;
use Yii;
use yii\base\Widget;

/**
 * Description of ShowFavoritesWidget
 *
 * @author kotov
 */
class ShowFavoritesWidget extends Widget
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
        $user = Yii::$app->user->getIdentity()->user;
        $filmsManager = FilmManagerFactory::getFavoritesFilmManager($this->filmRepository, $user);
        
        return $this->render('show',[
            'view' => 'category',
            'page' => 'favorites',
            'filmLists' => $filmsManager->getList()
        ]);
    }
}
