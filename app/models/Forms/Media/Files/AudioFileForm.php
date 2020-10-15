<?php

namespace app\models\Forms\Media\Files;

use app\models\ActiveRecord\Media\AudioContent;
use Yii;
use yii\base\Model;
use yii\helpers\StringHelper;

/**
 * Description of AudioFileForm
 *
 * @author kotov
 */
class AudioFileForm extends FileForm
{
    /**
     *
     * @var string
     */
    public $file;
         
    public function rules(): array 
    {
        return [
            [['file'], 'file', 'extensions' => 'mp3'],             
        ];
    }          
}
