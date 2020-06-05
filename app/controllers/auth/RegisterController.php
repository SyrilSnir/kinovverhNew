<?php

namespace app\controllers\auth;

use yii\web\Controller;
use app\core\services\Auth\SignupService;
use app\models\Forms\User\RegisterForm;
use app\core\manage\auth\UserIdentity;
use Yii;

/**
 * Description of SignupController
 *
 * @author kotov
 */
class RegisterController extends Controller
{
    /**
     *
     * @var SignupService
     */
    protected $signupService;
    
    public function __construct(
            $id, 
            $module, 
            SignupService $service, 
            $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->signupService = $service;
    }
    
    public function init() {
        parent::init();
        $this->viewPath = '@app/app/views/site';
    }
    
    public function actionIndex()
    {
        $signupForm = new RegisterForm();
        if ($signupForm->load(Yii::$app->request->post()) && $signupForm->validate()) {
            try {
                $user = $this->signupService->signup($signupForm);               
                Yii::$app->user->login(new UserIdentity($user));
                Yii::$app->session->setFlash('success', 'Поздравляем, Вы успешно зарегистрирован в системе');
                return $this->goHome();
            } catch(\DomainException $e) {
                Yii::$app->session->setFlash('auth-error', $e->getMessage());
            }
           
        }
        Yii::$app->view->params['showRegisterForm'] = true; // показать форму регистрации
        Yii::$app->view->params['RegisterFormModel'] = $signupForm; // модель для формы ввода
        return $this->render('index');
        
    }
    
}
