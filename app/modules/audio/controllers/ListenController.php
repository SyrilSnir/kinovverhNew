<?php

namespace app\modules\audio\controllers;

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
        return $slug;
    }
}
