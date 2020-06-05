<?php

namespace app\controllers;


use app\models\Forms\Media\TrailersForm;
use app\core\services\operations\Media\TrailersService;
use yii\web\UploadedFile;
use Yii;

/**
 * Description of TrailersController
 *
 * @author kotov
 */
class TrailersController extends BaseController
{
    /**
     *
     * @var TrailersService
     */
    public $service;
    
        public function __construct(
            $id, 
            $module, 
            TrailersService $service,
            $config = array()
            )
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    public function actionUpload($modelId)
    {        
        $trailersForm = new TrailersForm();
        if ($trailersForm->files = UploadedFile::getInstances($trailersForm, 'files')) {
            try {
                if (empty($trailersForm->files)) {
                    throw new DomainException('Ошибка');                     
                } 
                $this->service->addFiles($modelId, $trailersForm);
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
