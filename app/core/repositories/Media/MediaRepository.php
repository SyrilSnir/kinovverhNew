<?php

namespace app\core\repositories\Media;

use app\core\repositories\DataManipulationTrait;
use app\models\ActiveRecord\Media\Kinopanorama;

/**
 * Description of KinopanoramaMediaRepository
 *
 * @author kotov
 */
class MediaRepository
{
    use DataManipulationTrait;
    
    public static function findKinopanoramaById($id)
    {
        return Kinopanorama::find($id)
            ->andWhere(['id' => $id])
            ->one();
    }

}
