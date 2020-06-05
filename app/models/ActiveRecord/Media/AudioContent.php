<?php

namespace app\models\ActiveRecord\Media;

use yii\db\ActiveRecord;
use yiidreamteam\upload\FileUploadBehavior;
use yii\web\UploadedFile;
use Yii;

/**
 * Description of AudioContent
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
class AudioContent extends ActiveRecord
{
 const AUDIOFILE_EXTENSION = 'mp3';
    
    public static function tableName(): string
    {
        return '{{%media}}';
    }    
    
    public function behaviors(): array
    {
        $audioContentPath = $anonsImagePath = Yii::getAlias('@audioPath');
        
        return [
                    [            
                        'class' => FileUploadBehavior::class,
                        'attribute' => 'name',
                        'filePath' => $audioContentPath . DIRECTORY_SEPARATOR . '[[filename]].[[extension]]',
                        'fileUrl' => '@audioUrl/[[filename]].[[extension]]'        
                    ]
            ];
    }

    public static function create($description = '', $path = '', $url = '', $size = '', $mimeType = ''): self
    {        
        $audioContent = new self();
        $audioContent->description = $description;
        $audioContent->path = $path;
        $audioContent->url = $url;
        $audioContent->size = $size;
        $audioContent->media_category_id = MediaCategory::CATEGORY_AUDIO_MP3;
        $audioContent->mime_type = $mimeType;
        $audioContent->extension = self::AUDIOFILE_EXTENSION;

        return $audioContent;
        
    }

    public function edit($description = '', $path = '', $url = '', $size = '', $mimeType = '')
    {
        $mediaCategoryId = MediaCategory::CATEGORY_AUDIO_MP3;      
        $this->description = $description;
        $this->path = $path;
        $this->url = $url;
        $this->size = $size;
        $this->mime_type = $mimeType;
        $this->media_category_id = $mediaCategoryId;
        $this->extension = self::AUDIOFILE_EXTENSION;
    }  
    
    public static function find()
    {
        return parent::find()->where(['media_category_id' => MediaCategory::CATEGORY_AUDIO_MP3]);
    }
    
    public function setFile(UploadedFile $file) 
    {
        $this->name = $file;
    }
    
}
