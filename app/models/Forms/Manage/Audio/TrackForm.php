<?php

namespace app\models\Forms\Manage\Audio;

use yii\base\Model; 
use app\models\ActiveRecord\Media\AudioContent;
use app\models\ActiveRecord\Audio\Album;
use app\models\ActiveRecord\Audio\Track;
use yii\helpers\ArrayHelper;

/**
 * Description of TrackForm
 *
 * @author kotov
 */
class TrackForm extends Model
{
    public $name;
    public $track;
    public $media;
    public $album;


    public function __construct(Track $track = null,$config = array())
    {
        if ($track) {
            $this->name = $track->name;
            $this->track = $track->track_num;
            $this->media = $track->media_id;
            $this->album = $track->album_id;
            //$track
        }
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            ['name','required'],
            [['track','media','album'],'integer'],
        ];
    }
    
    public function mediaList()
    {
        $aResult = array_reduce (AudioContent::find()->orderBy('id')->asArray()->all(), function($carry,$element) {
            $carry[$element['id']] = ($element['description'] ? $element['description'] : $element['name']);
            return $carry;
        },[ '' => 'Не выбран ни один аудиофайл'] );
        return $aResult;
    }
    
    public function albumsList()
    {
        $aResult = array_merge(
                [''=>'Не выбран альбом'],
                ArrayHelper::map(Album::find()->orderBy('name')->asArray()->all(), 'id', 'name')
            );      
        return $aResult;
    }
        
   
}
