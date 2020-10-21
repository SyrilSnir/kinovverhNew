<?php

namespace app\core\repositories\Audio;

use app\core\exceptions\NotFoundException;
use app\core\repositories\DataManipulationTrait;
use app\core\repositories\RepositoryInterface;
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
    
    /**
    * 
    * @param type $code
    * @return Films
    */
   public function getAlbumByCode ($code) {
       if (!$album = Album::findOne(['code' => $code])) {
           throw new NotFoundException('Альбом не найден');
       }
       return $album;
   }    

}
