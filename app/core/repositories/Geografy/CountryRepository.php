<?php

namespace app\core\repositories\Geografy;

use app\models\ActiveRecord\Country;
use app\core\repositories\RepositoryInterface;
use app\core\repositories\DataManipulationTrait;

/**
 * Description of CountryRepository
 *
 * @author kotov
 */
class CountryRepository implements RepositoryInterface
{
    use DataManipulationTrait;
    
    public static function findById($id)
    {
        return Country::find($id)
            ->andWhere(['id' => $id])
            ->one();
    }
}
