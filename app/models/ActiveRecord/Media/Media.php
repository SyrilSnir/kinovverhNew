<?php

namespace app\models\ActiveRecord\Media;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\FileHelper;

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
 * @author kotov
 */
abstract class Media extends ActiveRecord
{    
    const FILE_DEFAULT_EXTENSION = '';
    const MEDIA_CATEGORY = 0;
    const URL_ALIAS = '';
    const PATH_ALIAS = '';
        
    public static function tableName(): string
    {
        return '{{%media}}';
    }    
    
    public static function create($file,$description = ''): self
    {        
        $content = new static();
        $content->name = $file;        
        $content->description = $description;
        $content->size = filesize($content->path);
        $content->mime_type = FileHelper::getMimeType($content->path);
        $content->media_category_id = static::MEDIA_CATEGORY;       
        $content->extension = static::FILE_DEFAULT_EXTENSION;

        return $content;        
    }  

    public function edit($file, $description = '')
    {
        $this->file = $file;
        $this->description = $description;
        $this->size = filesize($this->path);
        $this->mime_type = FileHelper::getMimeType($this->path);
    }  
    
    public static function find()
    {
        return parent::find()->where(['media_category_id' => static::MEDIA_CATEGORY]);
    }    

    public function getUrl():string
    {
        return Yii::getAlias(static::URL_ALIAS) . '/' . $this->name;
    }
    
    public function getPath():string
    {
        return Yii::getAlias(static::PATH_ALIAS) . DIRECTORY_SEPARATOR . $this->name;
    }    
}
