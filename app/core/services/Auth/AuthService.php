<?php

namespace app\core\services\Auth;

use app\models\Forms\User\LoginForm;
use app\core\repositories\User\UserRepository;
use app\models\ActiveRecord\User;
use yii\base\Model;

/**
 * Description of AuthService
 *
 * @author kotov
 */
class AuthService extends Model
{
    /**
     *
     * @var UserRepository
     */
    public $userRepository;
    
    public function __construct(UserRepository $repository, $config = array())
    {
        parent::__construct($config);
        $this->userRepository = $repository;
    }

    public function auth(LoginForm $loginForm):User
    {
        $user = $this->userRepository->findByLogin($loginForm->login);
        if (!$user || !$user->validatePassword($loginForm->password)) {
            throw new \DomainException('Неверное имя пользователя или пароль');
        }        
        return $user;
    }
}
