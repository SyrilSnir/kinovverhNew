<?php

namespace app\core\services\Files;

use yii\helpers\FileHelper;

/**
 * Description of MediaFileService
 *
 * @author kotov
 */
abstract class MediaFileService
{   
    /**
     *
     * @var string Имя файла
     */
    private $fileName;
    
    /**
     *
     * @var string Путь к файлу (устанавливаетсяы в методе [[$this->setPath()]])
     */
    protected $filePath;

    public function __construct()
    {
        $this->setPath();
    }
    
    /**
     * 
     * @param string $fileName
     * @return \self
     */
    public static function getInstance(string $fileName):self
    {
        $instance = new static();
        $instance->fileName = $fileName;
        return $instance;
        
    }
    /**
     * 
     * @return void
     */
    public function deleteFile(): void
    {
        FileHelper::unlink($this->getFullName());
        $this->postProcessDelete();
    }
    
    protected abstract function setPath():void;
    
    protected function postProcessDelete() {}


    /**
     * 
     * @param string $fileName Имя файла
     * @return void
     */
    public function setFileName(string $fileName): void
    {
        $this->fileName = $fileName;
    }

    public function getFileName(): string
    {
        return $this->fileName;
    }
    
    public function getFullName(): string
    {
        return $this->filePath . DIRECTORY_SEPARATOR . $this->fileName;
    }
}
