<?php

namespace app\modules\adminka\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;
use app\models\Forms\User\LoginForm;
use app\core\services\Auth\AuthService;
use app\core\manage\auth\UserIdentity;
use Yii;

/**
 * Description of LoginController
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
    
    /**
     *
     * @var LoginForm
     */
    protected $loginForm;
    
    public function __construct(
            $id, 
            $module,
            AuthService $authService, 
            LoginForm $form,
            $config = array())
    {
        parent::__construct($id, $module, $config);
        $this->authService = $authService;
        $this->loginForm = $form;
    }
    
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'denyCallback' => function ($rule, $action) {
                   throw new \Exception('Вы уже авторизованы в системе');
                },
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ]
            ]
        ];
    }
    public function actionIndex() 
    {
        $this->layout = 'main-login';
        if ($this->loginForm->load(Yii::$app->request->post()) &&
                $this->loginForm->validate()) {
            try {
                $user = $this->authService->auth($this->loginForm);
                Yii::$app->user->login(new UserIdentity($user));
                if (Yii::$app->user->can('adminPanel')) {
                    return $this->redirect('/adminka');
                }
                Yii::$app->user->logout();
                throw new \DomainException('Недостаточно прав для входа в административную часть сайта');
            } catch (\DomainException $e) {
                Yii::$app->session->setFlash('error', $e->getMessage()); 
            }
        }
        return $this->render('login',[
           'model' => $this->loginForm, 
        ]);
    }
}
