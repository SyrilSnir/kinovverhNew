<?php

namespace app\core\repositories\Media;

use app\core\repositories\RepositoryInterface;
use app\core\repositories\DataManipulationTrait;
use app\models\ActiveRecord\Media\Trailers;

/**
 * Description of TrailersRepository
 *
 * @author kotov
 */
class TrailersRepository implements RepositoryInterface
{
    use DataManipulationTrait;
    
        public static function findById($id)
    {
        return Trailers::find($id)
            ->andWhere(['id' => $id])
            ->one();
    }
    
    /**
     * 
     * @param type $filmId
     * @return Trailers[]
     */
    public function getImagesByFilmId($filmId) {
        return Trailers::findAll([
            'film_id' => $filmId
        ]);
    }
}
