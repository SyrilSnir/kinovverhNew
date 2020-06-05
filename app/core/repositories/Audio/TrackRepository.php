<?php

namespace app\core\repositories\Audio;

use app\core\repositories\RepositoryInterface;
use app\core\repositories\DataManipulationTrait;
use app\models\ActiveRecord\Audio\Track;

/**
 * Description of TrackRepository
 *
 * @author kotov
 */
class TrackRepository implements RepositoryInterface
{
    use DataManipulationTrait;
    
    public static function findById($id)
    {
        return Track::find()
            ->andWhere(['id' => $id])
            ->one();
    }   
}
