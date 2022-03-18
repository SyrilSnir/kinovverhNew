<?php


namespace app\models\ActiveRecord\Media;

/**
 * Description of Kinopanorama
 *
 * @author kotov
 */
class Kinopanorama extends Media
{
    const FILE_DEFAULT_EXTENSION = 'mp4';
    
    const MEDIA_CATEGORY = MediaCategory::CATEGORY_KINOPANORAMA;  
    
    const URL_ALIAS = '@filmsKinopanoramaMediaUrl';
    
    const PATH_ALIAS = '@filmsKinopanoramaMediaPath';
}
