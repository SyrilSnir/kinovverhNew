<?php

namespace app\controllers\auth;

use yii\web\Controller;
use Yii;
/**
 * Description of LogoutController
 *
 * @author kotov
 */
class LogoutController extends Controller
{
    public function actionIndex() {
        Yii::$app->user->logout();
        return $this->redirect("/");
    }
}
