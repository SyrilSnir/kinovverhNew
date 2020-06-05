<?php

namespace app\widgets\Category;

use yii\base\Widget;
use app\models\ActiveRecord\Film\Category;
use app\core\manage\films\FilmManagerFactory;
use app\core\repositories\Films\FilmRepository;

/**
 * Description of ShowCategoryWidget
 *
 * @author kotov
 */
class ShowCategoryWidget extends Widget
{
    /**
     *
     * @var Category
     */
    public $category;
    
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
    
    public function run(): string
    {
        $filmsManager = FilmManagerFactory::getFilmManagerForCategory(
                $this->filmRepository,
                $this->category
                );
        
        return $this->render('category', [
            'filmLists' => $filmsManager->getList()
        ]);
    }
}
