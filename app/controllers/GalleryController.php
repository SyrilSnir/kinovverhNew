<?php

namespace app\controllers;

use app\models\Forms\Media\GalleryForm;
use app\core\services\operations\Media\GalleryService;
use yii\web\UploadedFile;
use Yii;

/**
 * Description of GalleryController
 *
 * @author kotov
 */
class GalleryController extends BaseController
{
    /**
     *
     * @var GalleryService
     */
    protected $service;

    public function __construct(
            $id, 
            $module, 
            GalleryService $service,
            $config = array()
            )
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    public function actionUpload($modelId)
    {        
        $galleryForm = new GalleryForm();
        if ($galleryForm->files = UploadedFile::getInstances($galleryForm, 'files')) {
            try {
                if (empty($galleryForm->files)) {
                    throw new DomainException('Ошибка');                     
                } 
                $this->service->addFiles($modelId, $galleryForm);
            } catch (DomainException $e) {
                throw new DomainException($e);
            }
        }
        return \GuzzleHttp\json_encode(['message' => 'ok']);
    }
    
    public function actionDelete($modelId) 
    {        
        $result = true;
        $this->service->remove($modelId);
        return \GuzzleHttp\json_encode($result);
    }
}
