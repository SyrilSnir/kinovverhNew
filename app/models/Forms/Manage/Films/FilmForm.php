<?php

namespace app\models\Forms\Manage\Films;

use app\models\ActiveRecord\Media\VideoContent;
use app\models\ActiveRecord\Film\Genre;
use app\models\ActiveRecord\Film\Znak;
use app\models\ActiveRecord\Country;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use yii\base\Model;

/**
 * Description of FilmForm
 *
 * @author kotov
 */
abstract class FilmForm extends Model
{
    public $name;
    public $code;
    public $previewText;
    public $detailText;
    /**
     *
     * @var int Категории информационной продукции
     */
    public $category;
    public $media;
    public $country;
    public $year;
    public $time;
    public $rating;
    /**
     *
     * @var array
     */
    public $editorsList;    
    /**
     *
     * @var array
     */
    public $actorsList;
    /**
     *
     * @var array
     */
    public $genreList;
    
    /**
     *
     * @var Media
     */
    public $kinopanorama;
    public $anonsImageFile;
    public $anonsImage;
    public $kinopanoramaActive; 
    public $kinopanoramaFile;

    public function rules(): array
    {
        return [
            [['name','code','previewText'],'string'],
            [['rating'],'double'],
            [['editorsList', 'actorsList','genreList'],'each', 'rule' => ['integer']],
            [['editorsList', 'actorsList','genreList'],'default', 'value' => []],
            [['category','country','year','time','media'],'integer'],
            [['anonsImageFile'], 'image'],
            [['kinopanoramaFile'], 'file','skipOnEmpty' => true, 'extensions' => 'mp4'],
            [['kinopanoramaActive'], 'boolean'], 
        ];
    }
    
    public function beforeValidate(): bool
    {
        if (parent::beforeValidate()) {
            $this->anonsImageFile = UploadedFile::getInstance($this, 'anonsImageFile');
            $this->kinopanoramaFile = UploadedFile::getInstance($this, 'kinopanoramaFile');
            return true;
        }
        return false;
    }
    
    public function categoriesList()
    {
        return ArrayHelper::map(Znak::find()->orderBy('id')->asArray()->all(), 'id', 'name');
    }
    
    public function getGenres()
    {
        return ArrayHelper::map(Genre::find()->orderBy('id')->asArray()->all(), 'id', 'name');
    }
    
    public function countriesList()
    {
        return ArrayHelper::map(Country::find()->orderBy('id')->asArray()->all(), 'id', 'name');
    }
    
    public function mediaList()
    {
        $aResult = array_reduce (VideoContent::find()->orderBy('id')->asArray()->all(), function($carry,$element) {
            $carry[$element['id']] = ($element['description'] ? $element['description'] : $element['name']);
            return $carry;
        },[ '' => 'Не выбран ни один видеофайл'] );
        return $aResult;
    }

    public function attributeLabels(): array
    {
        return [
            'name' => 'Название фильма',
            'code' => 'Символьный идентификатор',
            'anonsImageFile' => 'Изображение для анонса',
            'previewText' => 'Текст для анонса',
            'detailText' => 'Подробное описание',
            'rating' => 'Рейтинг',
            'category' => 'Знак информационной продукции',
            'kinopanoramaActive' => 'Кинопанорама',
            'genreList' => 'Жанр(ы)',
            'editorsList' => 'Режиссёр(ы)',
            'actorsList' => 'В ролях:',
            'country' => 'Страна',
            'year' => 'Год выхода',
            'media' => 'Видеофайл, связанный с фильмом',
            'time' => 'Продолжительность (мин.)',
        ];
    }
}
