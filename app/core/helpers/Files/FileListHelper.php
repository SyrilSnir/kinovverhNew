<?php

namespace app\core\helpers\Files;

use yii\helpers\FileHelper;
use yii\helpers\StringHelper;

/**
 * Description of FileListHelper
 *
 * @author kotov
 */
class FileListHelper
{
    /**
     * Получить список файлов
     * @param string $directory
     * @param array $fileTypes
     * @return array
     */
    public static function fileList(string $directory, array $fileTypes = ['*']):array
    {
        return FileHelper::findFiles($directory,[
            'only' => $fileTypes
        ]);
    }
    
    /**
     * 
     * @param string $directory
     * @param array $fileTypes
     * @return array
     */
    public static function fileNamesList(string $directory, array $fileTypes = ['*']):array
    {
        $filesList = self::fileList($directory, $fileTypes);
        $result = [];
        foreach ($filesList as $element) {
            $fileName = basename($element);
            $hash = StringHelper::base64UrlEncode($fileName);
            $result[$hash] = $fileName;
        }
        return $result;
    }
}
