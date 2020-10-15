<?php

namespace app\controllers;

use app\models\Forms\Media\Files\AudioFileForm;
use app\models\Forms\Media\Files\VideoFileForm;
use app\models\Forms\Media\Files\FileForm;
use app\modules\adminka\controllers\BaseAdminController;
use Exception;
use Yii;
use yii\helpers\Json;
use yii\web\UploadedFile;

/**
 * Description of MediaController
 *
 * @author kotov
 */
class MediaController extends BaseAdminController
{
    public function actionUploadVideo()
    {
        $form = new VideoFileForm();
        $directory = Yii::getAlias('@kinofilmPath');
        try {
            if ($result = $this->fileUpload($form, $directory)) {
                    return Json::encode($result);            
            }        
        } catch (Exception $e) {
            return Json::encode([
                'errorMessage' => $e->getMessage()
            ]);    
        }
        
    }

    public function actionUploadAudio()
    {
        $form = new AudioFileForm();
        $directory = Yii::getAlias('@audioPath');
        try {
            if ($result = $this->fileUpload($form, $directory)) {
                    return Json::encode($result);            
            }        
        } catch (Exception $e) {
            return Json::encode([
                'errorMessage' => $e->getMessage()
            ]);    
        }
    } 
    
    private function fileUpload(FileForm $form, string $directory)
    {
        $file = UploadedFile::getInstance($form, 'file');
        if ($file) {
            $fileName = $file->name;
            $filePath = $directory . DIRECTORY_SEPARATOR . $fileName;            
            if ($form->className() == AudioFileForm::class) {
                $alias = Yii::getAlias('@audioUrl') . '/' . $fileName;
                $deleteUrl = '/adminka/file-manager/delete-audio?file='. \yii\helpers\StringHelper::base64UrlEncode($fileName);

            } elseif ($form->className() == VideoFileForm::class) {
                $alias = Yii::getAlias('@kinofilmUrl') . '/' . $fileName;
                $deleteUrl = '/adminka/file-manager/delete-video?file='. \yii\helpers\StringHelper::base64UrlEncode($fileName);
            } else {
                 throw new Exception('Неверные параметры запроса');
            }        
            if ($file->saveAs($filePath)) {
                return [
                    'files' => [
                        [
                            'name' => $fileName,
                            'size' => $file->size,
                            'url' => Yii::getAlias($alias),
                            'deleteUrl' => $deleteUrl,
                            'deleteType' => 'POST'
                        ]
                    ]
                ];

            }            
        }   
        throw new Exception('Загрузка файла завершилась неудачей');
    }
}
