<?php

namespace app\models\ActiveRecord\Widget;

use app\models\ActiveRecord\Film\Film;
use Yii;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use yiidreamteam\upload\ImageUploadBehavior;

/**
 * This is the model class for table "{{%carousel_widget_elements}}".
 *
 * @property int $id
 * @property string $name Заголовок
 * @property string $image Изображение
 * @property int|null $film_id Фильм
 * @property int|null $sort Порядковый носмер
 * @property Film|null $film Фильм, связанный с элементом
 * @method string|bull getUploadedFileUrl(string $attribute) Путь к файлу с изображением
 */
class CarouselWidgetElement extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%carousel_widget_elements}}';
    }

    public function behaviors()
    {
        $imagePath = Yii::getAlias('@mainPageCarouselPath');
        $imageUrl = Yii::getAlias('@mainPageCarouselUri');
        
        return [
            [
                 'class' => ImageUploadBehavior::class,
                 'attribute' => 'image',
                 'filePath' => $imagePath . DIRECTORY_SEPARATOR .'[[pk]]-gallery.[[extension]]',
                 'fileUrl' => $imageUrl . '/[[pk]]-gallery.[[extension]]',
            ],
        ];
    }
    
    public static function create(string $name, $filmId = null):self
    {
        $model = new self();
        $model->name = $name;
        $model->film_id = $filmId;        
        return $model;
    }
    
    public function edit(string $name, $filmId = null):void
    {
        $this->name = $name;
        $this->film_id = $filmId;
    }


    public function setImage(UploadedFile $image):void
    {
        $this->image = $image;
    }
    
    public function getFilm()
    {
        return $this->hasOne(Film::class, ['id' => 'film_id']);        
    }
    
}
