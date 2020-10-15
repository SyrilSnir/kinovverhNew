<?php

namespace app\models\Forms\Media;

use app\core\helpers\Files\FileListHelper;
use Yii;
use yii\base\Model;
use yii\helpers\StringHelper;

/**
 * Description of AudioFileForm
 *
 * @author kotov
 */
class AudioMaterialForm extends MediaForm
{

       
    public function rules(): array 
    {
        return [
            [['file'], 'isFileExist'], 
            [['description'],'string']
            
        ];
    } 
    

    public function isFileExist($attr,$params) :void
    {
        $fileName = StringHelper::base64UrlDecode($this->$attr);
        $fullPath = Yii::getAlias('@audioPath') . DIRECTORY_SEPARATOR . $fileName;
        if (!is_file($fullPath)) {
            $this->addError($attr, 'Файл с заданным именем не найден на сервере');            
        }
    }
    
    public function getFilesList(): array
    {
        return FileListHelper::fileNamesList(Yii::getAlias('@audioPath'), ['*.mp3']);
    }
}
