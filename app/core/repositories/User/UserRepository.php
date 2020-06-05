<?php

namespace app\core\repositories\User;

use app\models\ActiveRecord\User;
use app\core\repositories\RepositoryInterface;

use \app\core\repositories\DataManipulationTrait;

/**
 * Description of UserRepository
 *
 * @author kotov
 */
class UserRepository implements RepositoryInterface
{
    use DataManipulationTrait;
    
    public static function findById($id): ?User
    {
        return User::find()
                ->andWhere(['id' => $id])
                ->andWhere(['active' => User::STATUS_ACTIVE])
                ->one();
    }
    public function findByLogin($value):? User
    {
        return User::find()
                ->where(['active' => User::STATUS_ACTIVE])
                ->andWhere(['login' => $value])              
                ->one();
    }

}
