<?php

namespace app\models\Forms\Media;

use app\core\helpers\Files\FileListHelper;
use Yii;
use yii\base\Model;

/**
 * Description of VideoFileForm
 *
 * @author kotov
 */
class VideoMaterialForm extends MediaForm
{
    
    public function getFilesList(): array
    {
        return FileListHelper::fileNamesList(Yii::getAlias('@kinofilmPath'), ['*.mp4']);
    }
    
    public function isFileExist($attr,$params):void
    {
        $fileName = \yii\helpers\StringHelper::base64UrlDecode($this->$attr);
        $fullPath = Yii::getAlias('@kinofilmPath') . DIRECTORY_SEPARATOR . $fileName;
        if (!\is_file($fullPath)) {
            $this->addError($attr, 'Файл с заданным именем не найден на сервере');            
        }
    }
}
