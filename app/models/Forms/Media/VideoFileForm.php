<?php

namespace app\models\Forms\Media;

use app\models\ActiveRecord\Media\VideoContent;
use yii\web\UploadedFile;
use yii\base\Model;

/**
 * Description of VideoFileForm
 *
 * @author kotov
 */
class VideoFileForm extends Model
{
    /**
     *
     * @var string
     */
    public $videoFileUrl;
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
    
    public function __construct(VideoContent $content = null, $config = array())
    {
        if ($content) {
            $this->description = $content->description;
            $this->videoFileUrl = $content->url;            
        }
        parent::__construct($config);
    }
    
    public function rules(): array 
    {
        return [
            [['file'], 'file','extensions' => 'mp4'],
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
