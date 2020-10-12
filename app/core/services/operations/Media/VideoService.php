<?php

namespace app\core\services\operations\Media;

use app\core\repositories\Media\VideoRepository;
use app\models\ActiveRecord\Media\VideoContent;
use app\models\Forms\Media\VideoFileForm;
use yii\web\UploadedFile;

/**
 * Description of VideoService
 *
 * @author kotov
 */
class VideoService
{
    /**     
     * @var VideoRepository 
     */
    protected $videoRepository;
   
    public function __construct(VideoRepository $repository)
    {
        $this->videoRepository = $repository; 
    }
    
    public function create(VideoFileForm $form)
    {
        $videoFile = VideoContent::create($form->description);
        if ($form->file) {
            $videoFile->setFile($form->file);
        }
       $this->videoRepository->save($videoFile);
        $this->setVideoFileFields($videoFile, $form->file);
        return $videoFile; 
    }
    
    protected function setVideoFileFields(VideoContent $model, UploadedFile $file) 
    {
        $mediaPath = $model->getUploadedFilePath('name');
        $mediaUrl = $model->getUploadedFileUrl('name');
        $model->edit( 
                $model->description, 
                $file->size, 
                $file->type
                );
        $this->videoRepository->save($model);
    }
    
    public function remove ($id) 
    {
        /* @var $model VideoContent */
         $model = $this->videoRepository->findById($id);
         $this->videoRepository->remove($model);
    }
}
