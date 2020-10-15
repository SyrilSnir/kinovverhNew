<?php

namespace app\models\ActiveRecord\Media;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\FileHelper;

/**
 * Description of VideoContent
 *
 * @author kotov
 */
class VideoContent extends Media
{
    const FILE_DEFAULT_EXTENSION = 'mp4';
    
    const MEDIA_CATEGORY = MediaCategory::CATEGORY_FILM_MP4;  
    
    const URL_ALIAS = '@kinofilmUrl';
    
    const PATH_ALIAS = '@kinofilmPath';
}
