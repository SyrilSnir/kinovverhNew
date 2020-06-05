<?php

namespace app\core\manage;

use app\core\repositories\User\UserRepository;
use app\models\ActiveRecord\User;

/**
 * Description of UserManageService
 *
 * @author kotov
 */
class UserManageService
{
    const PASSWORD_ATTRIBUTE = 'password_hash';
    /**
     *
     * @var UserRepository
     */
    protected $repository;
    
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }
    
    /**
     * 
     * @param int $id
     * @param string $attributeName
     * @param string $attributeValue
     * @return User
     */
    public function setAttribute($id, $attributeName,$attributeValue):User
    {
 
        $model = $this->repository->findById($id);        
                
        if ($attributeName === self::PASSWORD_ATTRIBUTE) {
            $model->setPassword($attributeValue);
            $model->bitrix_user = 0;
        } else {
            $model->setAttribute($attributeName, $attributeValue);
        }
        $model->save();
        return $model;
    }
            
}
