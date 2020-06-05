<?php

namespace app\core\repositories\Media;

use app\core\repositories\RepositoryInterface;
use app\core\repositories\DataManipulationTrait;
use app\models\ActiveRecord\Media\VideoContent;

/**
 * Description of VideoRepository
 *
 * @author kotov
 */
class VideoRepository implements RepositoryInterface
{
    use DataManipulationTrait;
    
    
    public static function findById($id)
    {
        return VideoContent::find()
                ->andWhere(['id' => $id])
                ->one();
    }

}
