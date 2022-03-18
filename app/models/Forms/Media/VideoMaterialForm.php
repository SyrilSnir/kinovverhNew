<?php

namespace app\models\Forms\Media;

use app\core\helpers\Files\FileListHelper;
use app\models\ActiveRecord\Media\VideoContent;
use Yii;
use yii\helpers\StringHelper;

/**
 * Description of VideoFileForm
 *
 * @author kotov
 */
class VideoMaterialForm extends MediaForm
{
    
    public function __construct(VideoContent $model = null, $config = []) {
        if ($model) {
            $this->description = $model->description;
            $this->file = $model->hash;
        }
        parent::__construct($config);
    }  
    
    public function getFilesList(): array
    {
        return FileListHelper::fileNamesList(Yii::getAlias('@kinofilmPath'), ['*.mp4']);
    }
    
    public function isFileExist($attr,$params):void
    {
        $fileName = StringHelper::base64UrlDecode($this->$attr);
        $fullPath = Yii::getAlias('@kinofilmPath') . DIRECTORY_SEPARATOR . $fileName;
        if (!\is_file($fullPath)) {
            $this->addError($attr, 'Файл с заданным именем не найден на сервере');            
        }
    }
}
