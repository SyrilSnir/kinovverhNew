<?php

namespace app\controllers;

use app\core\helpers\ReadModels\PersonHelper;
use app\core\repositories\Films\FilmRepository;
use app\core\repositories\Films\GenreRepository;
use app\models\ActiveRecord\Film;
use app\models\ActiveRecord\Film\Category;
use app\models\ActiveRecord\Media\KinoPanoramaMedia;
use app\models\ActiveRecord\Media\VideoContent;
use Yii;
use yii\web\Controller;
use function dump;

/**
 * Description of TestController
 *
 * @author kotov
 */
class TestController extends Controller
{
    public function actionIndex()
    {
        $result = Yii::getAlias('@filmsAnonsImagePath') . '<br>' .
                Yii::getAlias('@filmsAnonsImageUrl') . '<br>' .
                Yii::getAlias('@yii') . '<br>' .
                Yii::getAlias('@web') . '<br>' .
                Yii::getAlias('@webroot') . '<br>' ;
        return $result;
    }
    
    public function actionModel()
    {
        $model = new KinoPanoramaMedia();
       // $model = new \app\models\ActiveRecord\Film();
        $model->name = 'test';
        dump($model); die;
    }
    
    public function actionPerson()
    {
        dump(
        PersonHelper::getPersonList()
                //$personsArray                
            );
    }
    
    public function actionActors() 
    {
        /** @var Film $film */
        $film = FilmRepository::findById(2);
        dump($film->actors);
    }
    
    public function actionGenre()
    {
        /* @var $genre Category */
        $genreRep = new GenreRepository();
        $genreList = $genreRep->getAll();
        
        $genre = $genreList[0];
        dump($genre->getFilms());
    }
    
    public function actionMedia()
    {
        dump(array_reduce (VideoContent::find()->orderBy('id')->asArray()->all(), function($carry,$element) {
            $carry[$element['id']] = [
                    'name' => ($element['description'] ? $element['description'] : $element['name'])            
                ];
            return $carry;
        } ) );
    }
    
    
}
