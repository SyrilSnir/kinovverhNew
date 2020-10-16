<?php

namespace app\models\Forms\Manage\Films;

use app\models\ActiveRecord\Film\Film;
use app\models\Forms\Media\GalleryForm;
use app\models\Forms\Media\TrailersForm;

/**
 * Description of FilmForm
 *
 * @author kotov
 */
class FilmEditForm extends FilmForm
{


    /**
     *
     * @var GalleryForm;
     */
    public $gallery;
    
    /**
     *
     * @var TrailersForm;
     */
    public $trailers;
    
  

    public function __construct(Film $model, $config = array())
    {
        $this->name = $model->name;
        $this->code = $model->code; 
        $this->rating = $model->rating;
        $this->previewText = $model->preview_text;
        $this->detailText = $model->detail_text;
        $this->kinopanoramaActive = $model->kinopanorama_active;
        $this->category = $model->category_id;
        $this->country = $model->country_id;
        $this->media = $model->media_id;
        $this->time = $model->time;
        $this->gallery = new GalleryForm();
        $this->trailers = new TrailersForm();
        $this->genreList = $model->genres;
        if ($model->kinopanorama) {
            $this->kinopanorama = $model->kinopanorama;
        }                    
        if ($model->hasAnonsImage()) {
            $this->anonsImage = $model->getAnonsImage();
        }
        
        if ($model->hasDetailImage()) {
            $this->detailImage = $model->getDetailImage();
        }
        $this->editorsList = $model->editors;
                //[1 => 'Рязанов',3 => 'Иванов'];
        $this->actorsList = $model->actors;
        parent::__construct($config);
    }

    public function rules(): array
    {
        $baseConfig = parent::rules();
        $currentConfig = [           
        ];
        return array_merge($currentConfig,$baseConfig);
    }   
    
    
}
