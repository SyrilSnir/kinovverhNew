<?php

namespace app\core\repositories\Media;

use app\core\repositories\RepositoryInterface;
use app\core\repositories\DataManipulationTrait;
use app\models\ActiveRecord\Media\Gallery;

/**
 * Description of GalleryRepository
 *
 * @author kotov
 */
class GalleryRepository implements RepositoryInterface
{
    use DataManipulationTrait;
    
    public static function findById($id)
    {
        return Gallery::find($id)
            ->andWhere(['id' => $id])
            ->one();
    }
    
    /**
     * 
     * @param type $filmId
     * @return Gallery[]
     */
    public function getImagesByFilmId($filmId) {
        return Gallery::findAll([
            'film_id' => $filmId
        ]);
    }

}
