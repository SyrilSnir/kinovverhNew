<?php

namespace app\models\ActiveRecord\Media;

use yii\db\ActiveRecord;

/**
 * Загруженные медиафайлы
 * 
 * @property integer $id
 * @property string $name
 * @property string $path
 * @property string $description
 * @property string $url
 * @property int $size
 * @property string $mime_type
 * @property string $extension
 * @property int $media_category_id
 * 
 * @author kotov
 */
class Media extends ActiveRecord
{    
    public static function tableName(): string
    {
        return '{{%media}}';
    }
    
    public static function create(
            $name,
            $description,
            $path,
            $url,
            $size,
            $mimeType,
            $extension = '',
            $mediaCategoryId = null
            ):self
    {
        $media = new self();
        $media->name = $name;
        $media->description = $description;
        $media->path = $path;
        $media->url = $url;
        $media->size = $size;
        $media->mime_type = $mimeType;
        $media->extension = $extension;
        $media->media_category_id = $mediaCategoryId;
                
        return $media;
    }
    
    public function edit(
            $name,
            $description,
            $path,
            $url,
            $size,
            $mimeType,
            $extension = '',
            $mediaCategoryId = null
            ) 
    {
        $this->name = $name;
        $this->description = $description;
        $this->path = $path;
        $this->url = $url;
        $this->size = $size;
        $this->mime_type = $mimeType;
        $this->extension = $extension;
        $this->media_category_id = $mediaCategoryId;
    }
    
}
