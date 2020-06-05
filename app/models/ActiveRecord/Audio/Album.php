<?php

namespace app\models\ActiveRecord\Audio;

use yii\db\ActiveRecord;
use app\models\TimestampTrait;
use app\models\ActiveRecord\Audio\Track;
use app\core\tools\Strings;
use yiidreamteam\upload\FileUploadBehavior;
use yii\web\UploadedFile;
use Yii;

/**
 * Description of Album
 * @property integer $id
 * @property integer $year
 * @property string $name
 * @property string $code
 * @property string $description
 * @property string|UploadedFile $image
 * @property string $image_path
 * @property string $image_url
 * @property integer $created_by
 * @property integer $created_at
 * @property integer $updated_at
 * @property Genre[] $genres
 * @property integer $active
 * @author kotov
 */
class Album extends ActiveRecord
{
    /**
     *
     * @var string|UploadedFile
     */
    public $image;

use TimestampTrait;
    
    public static function tableName(): string
    {
        return '{{%albums}}';
    }
    
    public static function create(
            $name,
            $code,
            $description,
            $year
            ) :self
    {
        $album = new self();
        $album->name = $name;
        $album->code = $code;
        $album->description = $description;
        $album->year = $year;        
        
        return $album;        
    }
    
    public function edit(
            $name,
            $code,
            $description,
            $year
            )
    {
        $this->name = $name;
        $this->code = $code;
        $this->description = $description;
        $this->year = $year;
    }

    public function __construct($config = array())
    {
        parent::__construct($config);
        $imagePath = Yii::getAlias('@albumPath');
        $this->attachBehavior('imageUploadBehavior', [
            'class' => FileUploadBehavior::class,
            'attribute' => 'image',
            'filePath' => $imagePath . DIRECTORY_SEPARATOR . '[[pk]]-album.[[extension]]',
            'fileUrl' => '@albumUrl/[[pk]]-album.[[extension]]'              
        ]);
    }
    
    public function setImage(UploadedFile $file) 
    {
        $this->image = $file;
    }
       

    public function beforeSave($insert)
    {
        if(empty($this->code)) {
            $this->code = strtolower(Strings::getTransliterateString($this->name));
        }
        return parent::beforeSave($insert);
    }
    
    public function getGenres() 
    {
        $junctionTableName = AlbumGenre::tableName();
        return $this->hasMany(Genre::class, ['id' => 'genre_id'])
                ->viaTable($junctionTableName, ['album_id' => 'id']);
    }
    
    public function getTracks()
    {
        $this->hasMany(Track::class, ['alnum_id' => 'id'])
                ->all();
    }
    
}
