<?php

namespace app\models\Forms\Manage\Widgets;

use app\core\traits\Lists\FilmsListTrait;
use app\models\ActiveRecord\Widget\CarouselWidgetElement;
use yii\base\Model;
use yii\web\UploadedFile;

/**
 * Description of CarouselElementForm
 *
 * @author kotov
 */
class CarouselElementForm extends Model
{
    use FilmsListTrait;
    
    /**
     *
     * @var string
     */
    public $name;
    
    /**
     *
     * @var type 
     */
    public $imageUrl;
    
    /**
     *
     * @var int
     */
    public $filmId;

    /**
     *
     * @var string
     */    
    public $image;
    
    public function __construct(CarouselWidgetElement $model = null, $config = [])
    {
        if ($model) {
            $this->name = $model->name;
            $this->filmId = $model->film_id;
            $this->image = $model->image;
            $this->imageUrl = $model->getUploadedFileUrl('image');
        }
    }
    
    public function rules():array
    {
        return [
            [['filmId'], 'integer'],
            [['name'], 'string'],
            [['name'], 'required'],
            [['image'], 'image']
        ];
        
    }
    
    public function beforeValidate(): bool
    {
        if (parent::beforeValidate()) {
            $this->image = UploadedFile::getInstance($this, 'image');
            return true;
        }
        return false;
    }
    
    public function attributeLabels()
    {
        return [
          'name' => 'Заголовок',
          'filmId' => 'Фильм',
          'image' => 'Изображение'
        ];
    }
    
}
