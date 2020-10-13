<?php

namespace app\widgets\Film;

use app\models\ActiveRecord\Media\VideoContent;
use yii\base\Widget;

/**
 * Description of ShowFilmWidget
 *
 * @author kotov
 */
class ShowFilmWidget extends Widget
{
    /**
     *
     * @var VideoContent
     */
    private $media;
    
    public function run()
    {
        return $this->render('player.php',[
            'media' => $this->media
        ]);
    }
    
    public function setMedia(VideoContent $media):void
    {
        $this->media = $media;
    }
}
