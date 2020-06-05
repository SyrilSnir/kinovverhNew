<?php

namespace app\models\ActiveRecord\Media;

use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use yiidreamteam\upload\FileUploadBehavior;
use yii\helpers\FileHelper;
use Yii;

/**
 * Description of Trailers
 * @property integer $id
 * @property integer $film_id
 * @property string $file_path
 * @property string $url
 * @property integer $sort
 * @author kotov
 */
class Trailers extends ActiveRecord
{
    /**
     *
     * @var UploadedFile
     */
    public $file; 
    
    public static function tableName(): string
    {
        return '{{%trailers}}';
    }
    
    public static function create($filmId, $sortIndex, UploadedFile $file) :self
    {
        $trailers = new static();
        $trailers->film_id = $filmId;
        $trailers->file = $file;
        $trailers->sort = $sortIndex;
        $trailers->file_path = '';
        $trailers->url = '';
        return $trailers;
    }
    
    public function behaviors(): array
    {
     //   $trailersUrl = Yii::getAlias('@trailersUrl');
        $trailersPath = Yii::getAlias('@trailersPath');
        return [
            [
                'class' => FileUploadBehavior::class,
                'attribute' => 'file',
                'filePath' => $trailersPath . DIRECTORY_SEPARATOR . $this->film_id . '-[[filename]].[[extension]]',
                'fileUrl' => '@trailersUrl/' . $this->film_id . '-[[filename]].[[extension]]'
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
