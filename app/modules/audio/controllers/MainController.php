<?php

namespace app\modules\audio\controllers;

use yii\web\Controller;
/**
 * Description of IndexController
 *
 * @author kotov
 */
class MainController extends Controller
{
    public function actionIndex() 
    {
        return $this->render('index');
    }
}
