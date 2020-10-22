<?php

namespace app\modules\audio\controllers;

use Yii;
use yii\web\Controller;

/**
 * Description of ListenController
 *
 * @author kotov
 */
class ListenController extends Controller
{
    public function actionIndex($slug)
    {
        $albumModel = Yii::$app->view->params['findedElement'];        
        return $this->render('tracklist',[
            'album' => $albumModel
        ]);
    }
}
