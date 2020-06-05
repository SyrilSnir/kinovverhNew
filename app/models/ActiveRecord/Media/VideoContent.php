<?php

namespace app\models\ActiveRecord\Media;

use yiidreamteam\upload\FileUploadBehavior;
use yii\web\UploadedFile;
use yii\db\ActiveRecord;
use Yii;

/**
 * Description of VideoContent
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
 * @author kotov
 */
class VideoContent extends ActiveRecord
{
    const VIDEOFILE_EXTENSION = 'mp4';
    
    public static function tableName(): string
    {
        return '{{%media}}';
    }    
    
    public function behaviors(): array
    {
        $videoContentPath = $anonsImagePath = Yii::getAlias('@kinofilmPath');
        
        return [
                    [            
                        'class' => FileUploadBehavior::class,
                        'attribute' => 'name',
                        'filePath' => $videoContentPath . DIRECTORY_SEPARATOR . '[[filename]].[[extension]]',
                        'fileUrl' => '@kinofilmUrl/[[filename]].[[extension]]'        
                    ]
            ];
    }

    public static function create($description = '', $path = '', $url = '', $size = '', $mimeType = ''): self
    {        
        $videoContent = new self();
        $videoContent->description = $description;
        $videoContent->path = $path;
        $videoContent->url = $url;
        $videoContent->size = $size;
        $videoContent->media_category_id = MediaCategory::CATEGORY_FILM_MP4;
        $videoContent->mime_type = $mimeType;
        $videoContent->extension = self::VIDEOFILE_EXTENSION;

        return $videoContent;
        
    }

    public function edit($description = '', $path = '', $url = '', $size = '', $mimeType = '')
    {
        $mediaCategoryId = MediaCategory::CATEGORY_FILM_MP4;      
        $this->description = $description;
        $this->path = $path;
        $this->url = $url;
        $this->size = $size;
        $this->mime_type = $mimeType;
        $this->media_category_id = $mediaCategoryId;
        $this->extension = self::VIDEOFILE_EXTENSION;
    }  
    
    public static function find()
    {
        return parent::find()->where(['media_category_id' => MediaCategory::CATEGORY_FILM_MP4]);
    }
    
    public function setFile(UploadedFile $file) 
    {
        $this->name = $file;
    }
}
