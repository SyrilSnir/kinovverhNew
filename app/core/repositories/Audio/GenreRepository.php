<?php

namespace app\core\repositories\Audio;

use app\core\repositories\RepositoryInterface;
use app\models\ActiveRecord\Audio\Genre;

use app\core\repositories\DataManipulationTrait;
/**
 * Description of MusicGenreRepository
 *
 * @author kotov
 */
class GenreRepository implements RepositoryInterface
{
    use DataManipulationTrait;
    
    
    public static function findById($id)
    {
        return Genre::find()
            ->andWhere(['id' => $id])
            ->one();
    }

}
