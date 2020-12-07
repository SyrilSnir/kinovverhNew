<?php

namespace app\controllers;

use yii\filters\AccessControl;
use yii\helpers\Url;

/**
 * Description of BaseAdminController
 *
 * @author kotov
 */
class AuthorithedController extends BaseController
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ]  
                ],
                'denyCallback' => function($rule, $action) {
                        return $action->controller->redirect(Url::to('/manage/auth'));
                },
            ]
        ];
    }
}
