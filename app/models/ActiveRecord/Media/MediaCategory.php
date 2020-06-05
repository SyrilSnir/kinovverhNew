<?php

namespace app\models\ActiveRecord\Media;

use yii\db\ActiveRecord;

/**
 * Категория медиа файлов
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * 
 * @author kotov
 */
class MediaCategory extends ActiveRecord
{
    const CATEGORY_KINOPANORAMA = 1;
    const CATEGORY_FILM_MP4 = 2;
    const CATEGORY_AUDIO_MP3 = 3;
    
    public static function tableName() 
    {
        return '{{%media_category}}';
    }
}
