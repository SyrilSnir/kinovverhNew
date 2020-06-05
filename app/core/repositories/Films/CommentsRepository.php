<?php

namespace app\core\repositories\Films;

use app\core\repositories\RepositoryInterface;
use yii\db\ActiveRecord;
use app\models\ActiveRecord\Film\FilmComment;

use app\core\repositories\DataManipulationTrait;

/**
 * Description of CommentsRepository
 *
 * @author kotov
 */
class CommentsRepository implements RepositoryInterface
{
    
    use DataManipulationTrait;
    
    public static function findById($id) :?ActiveRecord
    {
        return FilmComment::find()
                ->andWhere(['id' => $id])
                ->one();
        
    }
}
