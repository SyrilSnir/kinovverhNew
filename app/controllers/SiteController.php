<?php

namespace app\controllers;


use yii\web\Controller;


/**
 * Description of SiteController
 *
 * @author kotov
 */
class SiteController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
      //  return 'Index';
    }
}
