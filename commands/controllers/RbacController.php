<?php

use app\core\manage\auth\Rbac;
use app\models\ActiveRecord\UserType;
use yii\console\ExitCode;
use yii\web\Controller;

namespace app\commands\controllers;

/**
 * Description of RbacController
 *
 * @author kotov
 */
class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();
        $user = $auth->createRole(UserType::DEFAULT_USER_TYPE);
        $user->description = 'Пользователь';
        $auth->add($user);

        $admin = $auth->createRole(UserType::ROOT_USER_TYPE);
        $admin->description = 'Администратор';
        $auth->add($admin);
        $auth->addChild($admin, $user);
        
        $adminPanel = $auth->createPermission(Rbac::PERMISSION_ADMIN_PANEL);
        $adminPanel->description = 'Панель администратора';
        $auth->add($adminPanel);
        $auth->addChild($admin, $adminPanel);
        
        //print_r ($auth->getRoles());
        echo Yii::getAlias('@rbac') . "\n";

        return ExitCode::OK;
    }
}
