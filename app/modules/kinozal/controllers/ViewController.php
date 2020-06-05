<?php

namespace app\modules\kinozal\controllers;

use yii\web\Controller;
use app\core\helpers\Menu\KinozalMenuHelper;
use Yii;
/**
 * Description of ViewController
 *
 * @author kotov
 */
class ViewController extends Controller
{
    public function actionIndex($slug)
    {
        return $this->show($slug,'index',[
            'showFilm' => false
        ]);
    }
    
    public function actionView($slug)
    {
        return $this->show($slug,'view',[
            'showFilm' => true,
            'top_block' => [
                'viewFile' => 'view.top.block.php',
            ] 
        ]);
    }
    
    public function actionPanorama($slug)
    {
        return $this->show($slug, 'panorama',[
            'top_block' => [
                'viewFile' => 'panorama.top.block.php',                
            ]        
        ]);
    }
    
    public function actionComments($slug)
    {
        return $this->show($slug, 'comments');
    }
    
    protected function show($slug,$viewName,$options = []) 
    {   
        $filmModel = Yii::$app->view->params['findedElement'];
        $menu = KinozalMenuHelper::getMenu([
            'slug' => $slug,
            'view' => $viewName,
            'film' => $filmModel
                ]);
        return $this->render('main' , [
            'slug' => $slug,
            'menu' => $menu,
            'view' => $viewName,
            'film' => $filmModel,
            'options' => $options,
            'image' =>  Yii::$app->view->params['findedElement']
        ]);
    }
}
