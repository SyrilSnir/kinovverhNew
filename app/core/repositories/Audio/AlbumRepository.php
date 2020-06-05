<?php

namespace app\core\repositories\Audio;

use app\core\repositories\RepositoryInterface;
use app\core\repositories\DataManipulationTrait;
use app\models\ActiveRecord\Audio\Album;

/**
 * Description of AlbumRepository
 *
 * @author kotov
 */
class AlbumRepository implements RepositoryInterface
{
    use DataManipulationTrait;
    
    public static function findById($id)
    {
        return Album::find()
            ->andWhere(['id' => $id])
            ->one();
    }

}
