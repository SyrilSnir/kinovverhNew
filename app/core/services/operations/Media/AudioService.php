<?php

namespace app\core\services\operations\Media;

use app\core\repositories\Media\AudioRepository;
use app\models\ActiveRecord\Media\AudioContent;
use app\models\Forms\Media\AudioFileForm;
use yii\web\UploadedFile;

/**
 * Description of AudioService
 *
 * @author kotov
 */
class AudioService
{
    /**     
     * @var AudioRepository 
     */
    protected $audioRepository;
   
    public function __construct(AudioRepository $repository)
    {
        $this->audioRepository = $repository; 
    }
    
    public function create(AudioFileForm $form)
    {
        $audioFile = AudioContent::create($form->description);
        if ($form->file) {
            $audioFile->setFile($form->file);
        }
       $this->audioRepository->save($audioFile);
        $this->setAudioFileFields($audioFile, $form->file);
        return $audioFile; 
    }
    
    protected function setAudioFileFields(AudioContent $model, UploadedFile $file) 
    {
        $mediaPath = $model->getUploadedFilePath('name');
        $mediaUrl = $model->getUploadedFileUrl('name');
        $model->edit( 
                $model->description, 
                $mediaPath,
                $mediaUrl,
                $file->size, 
                $file->type
                );
        $this->audioRepository->save($model);
    }
    
    public function remove ($id) 
    {
        /* @var $model AudioContent */
         $model = $this->audioRepository->findById($id);
         $this->audioRepository->remove($model);
    }
}
