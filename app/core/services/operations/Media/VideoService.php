<?php

namespace app\core\services\operations\Media;

use app\core\repositories\Media\VideoRepository;
use app\models\ActiveRecord\Film\Film;
use app\models\ActiveRecord\Media\VideoContent;
use app\models\Forms\Media\VideoMaterialForm;
use Yii;
use yii\helpers\StringHelper;

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
    
    public function create(VideoMaterialForm $form)
    {
        $file = StringHelper::base64UrlDecode($form->file);
        $videoFile = VideoContent::create($file, $form->description);
        $this->videoRepository->save($videoFile);
        return $videoFile; 
    }    
    
    public function remove ($id) 
    {
        /* @var $model VideoContent */
        $db = Yii::$app->db;
        $model = $this->videoRepository->findById($id);
        $this->videoRepository->remove($model);
        $db->createCommand()->update(Film::tableName(), ['media_id' => NULL],['media_id' => $id])->execute();         
    }
}
