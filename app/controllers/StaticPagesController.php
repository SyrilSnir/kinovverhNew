<?php

namespace app\controllers;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use Yii;

/**
 * Для отображения страниц со статическим содержимым
 *
 * @author kotov
 */
class StaticPagesController extends Controller
{


    public function actionIndex($page)
    {
        return $this->getTemplate($page);
     //   dump($fileTemplate);
    //    die;
    }
    
    
    protected function getTemplate($page): string
    {
        switch ($page) {
            case 'o_kinozale':
            case 'conditions':
                return $this->render($page);     
        }
        throw new NotFoundHttpException();
    }
}
