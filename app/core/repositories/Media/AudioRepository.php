<?php

namespace app\core\repositories\Media;

use app\core\repositories\RepositoryInterface;
use app\core\repositories\DataManipulationTrait;
use app\models\ActiveRecord\Media\AudioContent;

/**
 * Description of AudioRepository
 *
 * @author kotov
 */
class AudioRepository implements RepositoryInterface
{
    use DataManipulationTrait;
    
    
    public static function findById($id)
    {
        return AudioContent::find()
                ->andWhere(['id' => $id])
                ->one();
    }

}