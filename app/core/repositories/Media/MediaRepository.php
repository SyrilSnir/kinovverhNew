<?php

namespace app\core\repositories\Media;

use app\models\ActiveRecord\Media\Media;
use app\core\repositories\RepositoryInterface;
use app\core\repositories\DataManipulationTrait;

/**
 * Description of KinopanoramaMediaRepository
 *
 * @author kotov
 */
class MediaRepository implements RepositoryInterface
{
    use DataManipulationTrait;
    
    public static function findById($id)
    {
        return Media::find($id)
            ->andWhere(['id' => $id])
            ->one();
    }

}
