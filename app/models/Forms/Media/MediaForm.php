<?php

namespace app\models\Forms\Media;

/**
 * Description of MediaForm
 *
 * @author kotov
 */
abstract class MediaForm extends \yii\base\Model
{
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
    
    public function rules(): array 
    {
        return [
            [['file'], 'isFileExist'], 
            [['description'],'string']
            
        ];
    }  
    
    public function attributeLabels()
    {
        return [
            'file' => 'Имя файла',
            'description' => 'Описание'
        ];
    }    
    
    abstract function isFileExist($attr,$params):void;
    
    abstract function getFilesList():array;
}
