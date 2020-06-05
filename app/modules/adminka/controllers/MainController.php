<?php

namespace app\modules\adminka\controllers;

/**
 * Description of MainController
 *
 * @author kotov
 */
class MainController extends BaseAdminController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
