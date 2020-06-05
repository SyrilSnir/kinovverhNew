<?php

namespace app\core\services\operations\User;


use app\models\ActiveRecord\User;
use app\core\repositories\User\UserRepository;
use app\models\Forms\Manage\User\UserForm;
/**
 * Description of UserService
 *
 * @author kotov
 */
class UserService
{
    /**
     *
     * @var UserRepository
     */
    protected  $users;
    
    public function __construct(UserRepository $repository)
    {
        $this->users = $repository;
    }
    
    public function edit($id, UserForm $form)
    {
        /* @var $user User */
        $user = $this->users->findById($id);
        $user->edit(
                $form->login, 
                $form->fio, 
                $form->birthday);
        $this->users->save($user);
    }
    
    
}
