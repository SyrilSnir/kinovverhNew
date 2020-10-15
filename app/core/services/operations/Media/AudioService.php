<?php

namespace app\core\services\operations\Media;

use app\core\repositories\Media\AudioRepository;
use app\models\ActiveRecord\Media\AudioContent;
use app\models\Forms\Media\AudioMaterialForm;
use yii\helpers\StringHelper;

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
    
    public function create(AudioMaterialForm $form)
    {
        $file = StringHelper::base64UrlDecode($form->file);
        $audioFile = AudioContent::create($file, $form->description);
        $this->audioRepository->save($audioFile);
        return $audioFile; 
    }
    
    public function remove ($id) 
    {
        /* @var $model AudioContent */
         $model = $this->audioRepository->findById($id);
         $this->audioRepository->remove($model);
    }
}
