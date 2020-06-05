<?php

namespace app\core\repositories\Films;

use app\core\repositories\RepositoryInterface;
use app\models\ActiveRecord\Film\Genre;

use app\core\repositories\DataManipulationTrait;

/**
 * Description of GenreRepository
 *
 * @author kotov
 */
class GenreRepository implements RepositoryInterface
{
    use DataManipulationTrait;
    
    public static function findById($id): ?Genre
    {
        return Genre::find()
                ->andWhere(['id' => $id])
                ->one();
    }
    
    public function getAll()
    {
        return Genre::find()->all();
    }        

}
