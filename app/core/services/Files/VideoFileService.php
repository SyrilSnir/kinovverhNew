<?php

namespace app\core\services\Files;

use app\models\ActiveRecord\Film\Film;
use app\models\ActiveRecord\Media\Media;
use app\models\ActiveRecord\Media\MediaCategory;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * Description of VideoFileService
 *
 * @author kotov
 */
class VideoFileService extends MediaFileService
{
    
    protected function setPath(): void
    {
        $this->filePath = Yii::getAlias('@kinofilmPath');        
    }
    
    protected function postProcessDelete()
    {
        parent::postProcessDelete();
        $db = Yii::$app->db;
        $mediaIds = ArrayHelper::getColumn(
                        Media::find()
                            ->where(['name' => $this->getFileName(),'media_category_id' => MediaCategory::CATEGORY_FILM_MP4])
                            ->asArray()
                            ->all(),
                        function ($element){
                            return (int) $element['id'];
                        });
        $db->createCommand()->update(Film::tableName(), ['media_id' => NULL],['media_id' => $mediaIds])->execute();
        Media::deleteAll(['id' => $mediaIds]);        
    }
}
