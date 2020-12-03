<?php

namespace app\core\manage\auth;

use yii\web\IdentityInterface;
use app\models\ActiveRecord\User;
use yii\base\Model;
use app\core\repositories\User\UserRepository;

/**
 * Description of UserIdentity
 *
 * @property string $login Логин
 * @author kotov
 */
class UserIdentity extends Model implements IdentityInterface
{
    /**
     *
     * @var User
     */
    protected $user;
    
    public function __construct(User $user)
    {
        parent::__construct();
        $this->user = $user;
    }

    public function getAuthKey(): string
    {
        return $this->user->auth_key;
    }

    public function getId()
    {
        return $this->user->id;
    }

    public function validateAuthKey($authKey): bool
    {
        return $this->user->auth_key = $authKey;
    }

    public static function findIdentity($id): IdentityInterface
    {
        $user = UserRepository::findById($id);
        return $user ? new self($user) : null;
    }

    public static function findIdentityByAccessToken($token, $type = null): IdentityInterface
    {
        
    }
    
    public function getName()
    {
        return $this->user->fio ? $this->user->fio : $this->user->login;
    }
    
    public function getFio()
    {
        return $this->user->fio;
    }
    
    public function getLogin()
    {
        return $this->user->login;
    }
    
    public function getBirthday()
    {
        return $this->user->birthday;
    }
    
    public function getUser()
    {
        return $this->user;
    }    

}
