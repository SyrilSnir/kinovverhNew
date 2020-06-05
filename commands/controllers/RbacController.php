<?php

namespace app\commands\controllers;

use yii\console\Controller;
use yii\console\ExitCode;
use app\core\manage\auth\Rbac;
use Yii;

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
        $user = $auth->createRole('user');
        $user->description = 'Пользователь';
        $auth->add($user);

        $admin = $auth->createRole('admin');
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
