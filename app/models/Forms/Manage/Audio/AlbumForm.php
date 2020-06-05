<?php

namespace app\models\Forms\Manage\Audio;

use yii\base\Model;
use app\models\ActiveRecord\Audio\Album;
use app\models\ActiveRecord\Audio\Genre;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

/**
 * Description of AlbumForm
 *
 * @author kotov
 */
class AlbumForm extends Model
{
    public $name;
    public $year;
    public $code;
    public $description;
    /**
     *
     * @var array
     */
    public $genreList;
    
    public $imageFile;
    
    
    public function __construct(Album $album = null, $config = [])
    {
        if ($album) {
            $this->name = $album->name;
            $this->year = $album->year;
            $this->code = $album->code;
            $this->description = $album->description;
            $this->imageFile = $album->image_url;
            $this->genreList = $album->genres;
        }
        parent::__construct($config);
    }

        public function rules(): array
    {
        return [
            ['name','required'],
            [['name','code','description'],'string'],
            [['year'],'integer'],
            [['imageFile'], 'image'],
            [['genreList'],'default', 'value' => []],
        ];
    }
    
    public function attributeLabels(): array
    {
        return [
            'name' => 'Название альбома',
            'code' => 'Символьный код',
            'description' => 'Текстовое описание',
            'year' => 'Год издания',
            'imageFile' => 'Изображение'
        ];
    }

    public function beforeValidate(): bool
    {
        if (parent::beforeValidate()) {
            $this->imageFile = UploadedFile::getInstance($this, 'imageFile');
            return true;
        }
        return false;
    }
    
    public function getGenres()
    {
        return ArrayHelper::map(Genre::find()->orderBy('id')->asArray()->all(), 'id', 'name');
    }
    
}
