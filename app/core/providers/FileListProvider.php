<?php

namespace app\core\providers;

use app\core\helpers\Files\FileListHelper;
use Yii;
use yii\data\ArrayDataProvider;
use yii\helpers\FileHelper;

/**
 * Description of FileListProvider
 *
 * @author kotov
 */
class FileListProvider
{
    /**
     *
     * @var ArrayDataProvider
     */
    private $_provider;
    
    public function __construct(ArrayDataProvider $provider)
    {
        $this->_provider = $provider;
    }
    
    /**
     * Сконфигурировать провайдер, возвращающий список файлов
     * @param string $directory 
     * @param array $fileTypes
     */
    public function setup(string $directory, array $fileTypes)
    {
        $files = FileListHelper::fileList($directory, $fileTypes);
        $list = [];
        $index = 1;
        foreach ($files as $file) {
            $list[] = [
                '№' => $index++,
                'name' => basename($file),
                'mime' => FileHelper::getMimeType($file),
                'size' => Yii::$app->formatter->asShortSize(filesize($file))
            ];
        }
        $this->_provider->allModels = $list;
    }

    public function getProvider(): ArrayDataProvider
    {
        return $this->_provider;
    }



}
