<?php

namespace app\models\Forms\Media\Files;

use app\core\helpers\Files\FileListHelper;
use app\models\Forms\Media\Files\FileForm;
use yii\helpers\StringHelper;

/**
 * Description of VideoFileForm
 *
 * @author kotov
 */
class VideoFileForm extends FileForm
{    
    public function rules(): array 
    {
        return [
            [['file'], 'file', 'extensions' => 'mp4'], 
            [['description'],'string']
        ];
    }           
}
