<?php

namespace app\widgets\Audio;

use app\models\ActiveRecord\Audio\Album;
use yii\base\Widget;

/**
 * Description of AlbumPlayWidget
 *
 * @author kotov
 */
class AlbumPlayWidget extends Widget
{
    /**
     *
     * @var Album
     */
    private $album;    
    
    public function run(): string
    {
        return $this->render('audioplayer',[
            'album' => $this->album
        ]);
    }
    
    public function setAlbum(Album $album): void
    {
        $this->album = $album;
    }
}
