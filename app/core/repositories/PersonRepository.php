<?php

namespace app\core\repositories;

use app\models\ActiveRecord\Person;

/**
 * Description of PersonRepository
 *
 * @author kotov
 */
class PersonRepository implements RepositoryInterface
{
    use DataManipulationTrait;
    
    public static function findById($id)
    {
        return Person::find($id)
            ->andWhere(['id' => $id])
            ->one();
    }
    
    /**
     * 
     * @return iterable
     */
    public static function getAll() : iterable
    {
        return Person::find()
                ->all();
    }
}
