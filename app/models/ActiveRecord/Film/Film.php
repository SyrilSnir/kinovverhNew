<?php

namespace app\models\ActiveRecord\Film;

use yii\db\ActiveRecord;
use app\core\tools\Strings;
use app\models\TimestampTrait;
use app\models\ActiveRecord\Film\Znak;
use app\models\ActiveRecord\Country;
use app\models\ActiveRecord\Person;
use app\models\ActiveRecord\Media\Gallery;
use app\models\ActiveRecord\Media\Trailers;
use app\models\ActiveRecord\Film\FilmGenre;
use app\models\ActiveRecord\Occupation;
use app\models\ActiveRecord\Person\FilmPersonOccupation;
use app\models\ActiveRecord\Film\FilmComment;
use app\models\ActiveRecord\Media\VideoContent;
use yiidreamteam\upload\FileUploadBehavior;
use yii\web\UploadedFile;
use app\models\ActiveRecord\Media\Media;
use Yii;

/**
 * Информация о звгруженных фильмах
 * @property integer $id
 * @property string $name
 * @property string $code
 * @property string $preview_text
 * @property string $detail_text
 * @property integer $year 
 * @property integer $category_id
 * @property integer $kinopanorama_id
 * @property integer $country_id
 * @property integer $media_id
 * @property integer $time
 * @property integer $rating
 * @property string $images
 * @property string $anonsImage картинка для вывода в категории
 * @property UploadedFile $anonsImageFile 
 * @property string $detailImage картинка для вывода в детальном показе
 * @property boolean $kinopanorama_active Показать кинопанораму (да/нет)
 * @property Media $kinopanorama Показать кинопанораму (да/нет)
 * @property UploadedFile $kinopanoramaFile
 * @property integer $shows
 * @property Genre[] $genres
 * @property Person[] $actors
 * @property Person[] $editors
 * @property Gallery[] $gallery
 * @property Trailers[] $trailers
 * @property Znak $category
 * @property VideoContent $media
 * @property Country $country
 * @property FilmComment[] $comments все комментарии
 * @property FilmComment[] $moderateComments комментарии на модерации
 * @property FilmComment[] $availableComments доступные комментарии
 * @property integer $downloads
 * @property integer $created_by
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $active
 * 
 * @mixin ImageUploadBehavior
 * 
 * @author kotov
 */
class Film extends ActiveRecord
{
    /**
     *
     * @var UploadedFile
     */
    public $anonsImageFile;
    /**
     *
     * @var UploadedFile
     */
    public $kinopanoramaFile;
    /**
     *
     * @var Информация об прикрепленных изображениях
     */
    protected $_imagesCache = [];
    
    use TimestampTrait;        
    
    public function __construct($config = array())
    {
        parent::__construct($config);
        $anonsImagePath = Yii::getAlias('@filmsAnonsImagePath');
        $kinopanoramaMediaPath = Yii::getAlias('@filmsKinopanoramaMediaPath'); 
        $this->attachBehavior('imageUploadBehavior', [
            'class' => FileUploadBehavior::class,
            'attribute' => 'anonsImageFile',
            'filePath' => $anonsImagePath . DIRECTORY_SEPARATOR . '[[pk]]-anons.[[extension]]',
            'fileUrl' => '@filmsAnonsImageUrl/[[pk]]-anons.[[extension]]'                     
        ]);
        $this->attachBehavior('kinopanoramaUploadBehavior', [
            'class' => FileUploadBehavior::class,
            'attribute' => 'kinopanoramaFile',
            'filePath' => $kinopanoramaMediaPath . DIRECTORY_SEPARATOR . '[[pk]]-kinopanorama.[[extension]]',
            'fileUrl' => '@filmsKinopanoramaUrl/[[pk]]-kinopanorama.[[extension]]'
        ]);
    }
    
    public static function create(
            $name,
            $code,
            $previewText,
            $detailText,
            $mediaId,
            $categoryId,
            $countryId,
            $year,
            $time,
            $rating,
            $kinopanoramaActive
            ) 
    {
        $film = new self();
        $film->name = $name;
        $film->code = $code;
        $film->preview_text = $previewText;
        $film->detail_text = $detailText;
        $film->media_id = $mediaId;
        $film->category_id = $categoryId;
        $film->country_id = $countryId;
        $film->year = $year;
        $film->time = $time;
        $film->rating = $rating;
        $film->kinopanorama_active = $kinopanoramaActive;
        return $film;
    }
    
    public function setAnonsImageFile(UploadedFile $file) 
    {
        $this->anonsImageFile = $file;
    }
    
    public function setKinopanoramaFile(UploadedFile $file) 
    {
        $this->kinopanoramaFile = $file;
    }

    public function edit (
            $name,
            $code,
            $previewText,
            $detailText,
            $categoryId,
            $countryId,
            $mediaId,
            $year,
            $time,
            $rating,
            $kinopanoramaActive
        )
    {    
        $this->name = $name;
        $this->code = $code;
        $this->preview_text = $previewText;
        $this->detail_text = $detailText;
        $this->category_id = $categoryId;
        $this->country_id = $countryId;
        $this->media_id = $mediaId;
        $this->year = $year;
        $this->time = $time;
        $this->rating = $rating;
        $this->kinopanorama_active = $kinopanoramaActive;
    }

    public function beforeSave($insert) {
        if (empty($this->code)) {
            $this->code = strtolower(Strings::getTransliterateString($this->name));
        }
        return parent::beforeSave($insert);
    }
    
    public static function tableName(): string
    {
        return '{{%films}}';
    }
    
    public function getCategory()
    {
        return $this->hasOne(Znak::class, ['id' => 'category_id']);
    }
    
    public function getKinopanorama() 
    {
        return $this->hasOne(Media::class, ['id' => 'kinopanorama_id']);
    }

    public function getCountry()
    {
        return $this->hasOne(Country::class, ['id' => 'country_id']);
    }
    
    public function getEditors() 
    {
        return $this->getPerson(Occupation::KV_EDITOR);
    }
    
    public function getActors() 
    {
        return $this->getPerson(Occupation::KV_ACTOR);
    }
    
    public function getGallery()
    {
        return $this->hasMany(Gallery::class, ['film_id' => 'id']);
    }
    
    public function getMedia()
    {
        return $this->hasOne(VideoContent::class, ['id' => 'media_id']);
    }

    public function getTrailers()
    {
        return $this->hasMany(Trailers::class,  ['film_id' => 'id']);
    }

    public function getAnonsImage() : string
    {
        $noImageUrl = Yii::getAlias('@filmsImageUrl') . '/no-image.jpg';
        return $this->getImage('anons_image', $noImageUrl);
    }

    public function getDetailImage() : string
    {
        $noImageUrl = Yii::getAlias('@filmsImageUrl') . '/no-image.jpg';
        return $this->getImage('detail_image',$noImageUrl);
    }
    
    public function getAvailableComments() 
    {
        return $this->hasMany(FilmComment::class, ['film_id' => 'id'])->where('moderate = 1');
    }
    
    public function hasAnonsImage() :bool
    {
        $imagesArray = $this->loadImagesInfo();
        return key_exists('anons_image', $imagesArray);        
    }
    
    public function setAnonsImage($anonsImageUrl)
    {
        $imagesInfo = $this->loadImagesInfo();
        $imagesInfo['anons_image'] = $anonsImageUrl;
        $this->images = \GuzzleHttp\json_encode($imagesInfo);
    }

    public function hasDetailImage() : bool
    {
        $imagesArray = $this->loadImagesInfo();
        return key_exists('anons_image', $imagesArray);
    }
    
    public function getGenres() 
    {
        $junctionTableName = FilmGenre::tableName();
        return $this->hasMany(Genre::class, ['id' => 'genre_id'])
                ->viaTable($junctionTableName, ['film_id' => 'id']);
    }

    protected function getPerson($personType) {
        $junctionTableName = FilmPersonOccupation::tableName(); // промежуточная связующая таблица
        return $this->hasMany(Person::class, ['id' => 'person_id'])
                ->viaTable($junctionTableName, ['film_id' => 'id'],function ($query) use ($personType) {
                    $query->andWhere(['occupation_id' => $personType]);
              });
    }
    
    protected function loadImagesInfo() : array
    {
        if (!empty($this->_imagesCache) || empty($this->images)) {
            return $this->_imagesCache;
        }
        try {
            $this->_imagesCache = \GuzzleHttp\json_decode($this->images, true);
            return $this->_imagesCache;
        } catch ( \InvalidArgumentException $e) {
            return [];            
        }  
    }
    
    protected function clearImagesCahe() 
    {
        $this->_imagesCache = [];
    }

    protected function getImage($type,$defaultValue = false)
    {
        $imagesArray = $this->loadImagesInfo();
        $filmImage = key_exists($type, $imagesArray) ?
                                    $imagesArray[$type] : 
                                    $defaultValue;
        return $filmImage;
    }
}
