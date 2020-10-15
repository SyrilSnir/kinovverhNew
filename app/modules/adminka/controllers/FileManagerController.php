<?php

namespace app\modules\adminka\controllers;

use app\core\providers\FileListProvider;
use app\core\services\Files\MediaFileService;
use app\core\services\Files\VideoFileService;
use app\models\Forms\Media\Files\AudioFileForm;
use app\models\Forms\Media\Files\VideoFileForm;
use DomainException;
use Yii;
use yii\helpers\StringHelper;

/**
 * Description of FileManager
 *
 * @author kotov
 */
class FileManagerController extends BaseAdminController
{
    /**
     *
     * @var FileListProvider
     */
    private $fileListProvider;


    public function __construct(
            $id, 
            $module, 
            FileListProvider $fileListProvider,
            $config = array())
    {
        parent::__construct($id, $module, $config);
        $this->fileListProvider = $fileListProvider;        
    }
    
    public function actionVideo()
    {
        $model = new VideoFileForm();
        $this->fileListProvider->setup(Yii::getAlias('@kinofilmPath'), ['*.mp4']);        
        return $this->render('file-load',[
            'model' => $model,
            'dataProvider' => $this->fileListProvider->getProvider()
        ]);
    }
    
    public function actionAudio()
    {
        $model = new AudioFileForm();
        $this->fileListProvider->setup(Yii::getAlias('@audioPath'), ['*.mp3']);
        return $this->render('file-load',[
            'model' => $model,
            'dataProvider' => $this->fileListProvider->getProvider()
        ]);
    }    
    
    public function actionDeleteVideo(string $file) 
    {
        $fileName = StringHelper::base64UrlDecode($file);
        $service = VideoFileService::getInstance($fileName);
        try {
            $this->deleteFile($service);
        } catch (DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['video']);                
    }
    
    private function deleteFile(MediaFileService $service)
    {        
        $service->deleteFile();
    }
}
