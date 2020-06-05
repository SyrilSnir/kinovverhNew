<?php

namespace app\controllers;

use app\core\tools\Messages;
use app\core\manage\UserManageService;
use yii\web\Controller;
use Yii;
/**
 * Личный кабинет пользователя
 *
 * @author kotov
 */
class CabinetController extends Controller
{
    /**
     * @var UserManageService
     */
    protected $userManageService;
    
    public function __construct(
            $id, 
            $module, 
            UserManageService $userManageService,
            $config = array())
    {        
        parent::__construct($id, $module, $config);
        $this->userManageService = $userManageService;
    }

        public function actionIndex()
    {
        return $this->render('index');
    }
    
    public function actionSave()
    {
        $attributeName = Yii::$app->request->post('name');
        $attributeValue = Yii::$app->request->post('value');
        if (!empty($attributeName) && !empty($attributeValue)) {
            $userId = Yii::$app->user->getId();
            $this->userManageService->setAttribute($userId, $attributeName, $attributeValue);
            return Messages::getMessage('Данные успешно сохранены');            
        }
        return Messages::getErrorMessage('Поле ввода не заполнено');
    }
}
