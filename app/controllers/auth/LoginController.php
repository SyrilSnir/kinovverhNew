<?php

namespace app\controllers\auth;

use yii\web\Controller;
use app\models\Forms\User\LoginForm;
use app\core\services\Auth\AuthService;
use app\core\manage\auth\UserIdentity;
use Yii;

/**
 * Description of AuthController
 *
 * @author kotov
 */

class LoginController extends Controller
{
        /**
     *
     * @var AuthService
     */
    protected $authService;
    
    public function __construct(
            $id, 
            $module,
            AuthService $authService, 
            $config = array())
    {
        parent::__construct($id, $module, $config);
        $this->authService = $authService;
    }
    
    public function init() {
        parent::init();
        $this->viewPath = '@app/app/views/site';
    }
    
    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $loginForm = new LoginForm();
        if ($loginForm->load(Yii::$app->request->post()) && $loginForm->validate()) {
            try {
                $user = $this->authService->auth($loginForm);
                Yii::$app->user->login(new UserIdentity($user));
                return $this->goBack();
            } catch (\DomainException $e) {
                Yii::$app->session->setFlash('auth-error', $e->getMessage());
            }
        }
        Yii::$app->view->params['showLoginForm'] = true; // показать форму входа
        Yii::$app->view->params['LoginFormModel'] = $loginForm; // модель для формы ввода
        return $this->render('index');
    }
}
