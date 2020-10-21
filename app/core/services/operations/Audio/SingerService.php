<?php

namespace app\core\services\operations\Audio;

use app\models\ActiveRecord\Audio\AlbumSinger;

/**
 * Description of SingerService
 *
 * @author kotov
 */
class SingerService
{
    public function clearSingersForAlbum(int $albumId) 
    {
        AlbumSinger::deleteAll([
            'album_id' => $albumId
        ]);
    }
}
