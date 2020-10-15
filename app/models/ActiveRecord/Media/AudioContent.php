<?php

namespace app\models\ActiveRecord\Media;

use yii\db\ActiveRecord;
use yiidreamteam\upload\FileUploadBehavior;
use yii\web\UploadedFile;
use Yii;

/**
 * Description of AudioContent
 *
 * @author kotov
 */
class AudioContent extends Media
{
    const FILE_DEFAULT_EXTENSION = 'mp3';
    
    const MEDIA_CATEGORY = MediaCategory::CATEGORY_AUDIO_MP3;
    
    const URL_ALIAS = '@audioUrl';
    
    const PATH_ALIAS = '@audioPath';          
}
