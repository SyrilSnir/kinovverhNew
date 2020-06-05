<?php

namespace app\models\Forms\Media;

use app\models\ActiveRecord\Media\AudioContent;
use yii\web\UploadedFile;
use yii\base\Model;

/**
 * Description of AudioFileForm
 *
 * @author kotov
 */
class AudioFileForm extends Model
{
    /**
     *
     * @var string
     */
    public $audioFileUrl;
    /**
     *
     * @var string
     */
    public $file;
    
    /**
     *
     * @var string
     */
    public $description;
    
    public function __construct(AudioContent $content = null, $config = array())
    {
        if ($content) {
            $this->description = $content->description;
            $this->audioFileUrl = $content->url;            
        }
        parent::__construct($config);
    }
    
    public function rules(): array 
    {
        return [
            [['file'], 'file','extensions' => 'mp3'],
            ['description','safe'],
            
        ];
    } 
    
    public function attributeLabels()
    {
        return [
            'description' => 'Описание (может использоваться вместо имени файла)'
        ];
    }
    
    public function beforeValidate(): bool
    {
        if (parent::beforeValidate()) {
            $this->file = UploadedFile::getInstance($this, 'file');
            return true;
        }
        return false;
    }
    
}
