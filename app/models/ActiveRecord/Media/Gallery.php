<?php

namespace app\models\ActiveRecord\Media;

use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use yiidreamteam\upload\FileUploadBehavior;
use yii\helpers\FileHelper;
use Yii;

/**
 * Description of GalleryModel
 * @property integer $id
 * @property integer $film_id
 * @property string $file_path
 * @property string $url
 * @property integer $sort
 * @author kotov
 */
class Gallery extends ActiveRecord
{
    /**
     *
     * @var UploadedFile
     */
    public $file; 
    
    public static function tableName(): string
    {
        return '{{%gallery}}';
    }
    
    public static function create($filmId, $sortIndex, UploadedFile $file) :self
    {
        $gallery = new static();
        $gallery->film_id = $filmId;
        $gallery->file = $file;
        $gallery->sort = $sortIndex;
        $gallery->file_path = '';
        $gallery->url = '';
        return $gallery;
    }        

    public function behaviors(): array
    {
     //   $galleryUrl = Yii::getAlias('@galleryUrl');
        $galleryPath = Yii::getAlias('@galleryPath');
        return [
            [
                'class' => FileUploadBehavior::class,
                'attribute' => 'file',
                'filePath' => $galleryPath . DIRECTORY_SEPARATOR . $this->film_id . '-[[filename]].[[extension]]',
                'fileUrl' => '@galleryUrl/' . $this->film_id . '-[[filename]].[[extension]]'
            ]
        ];
    }
    
    public function afterDelete()
    {
        parent::afterDelete();
        $file = $this->file_path;
        FileHelper::unlink($file);
    }
}
