<?php

namespace app\core\services\Auth;

use app\models\Forms\User\RegisterForm;
use app\models\ActiveRecord\User;

/**
 * Description of SignupService
 *
 * @author kotov
 */
class SignupService 
{
    public function signup(RegisterForm $form):User
    {
        $user = User::create(
                $form->login,         
                $form->password
            );
        $user->save();
        return $user;
    }
}
