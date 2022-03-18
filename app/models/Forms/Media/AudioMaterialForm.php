<?php

namespace app\models\Forms\Media;

use app\core\helpers\Files\FileListHelper;
use app\models\ActiveRecord\Media\AudioContent;
use Yii;
use yii\helpers\StringHelper;

/**
 * Description of AudioFileForm
 *
 * @author kotov
 */
class AudioMaterialForm extends MediaForm
{

    public function __construct(AudioContent $model = null, $config = []) {
        if ($model) {
            $this->description = $model->description;
            $this->file = $model->hash;
        }
        parent::__construct($config);
    }            

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
