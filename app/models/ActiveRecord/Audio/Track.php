<?php

namespace app\models\ActiveRecord\Audio;

use yii\db\ActiveRecord;

/**
 * Description of Track
 * 
 * @property integer $id
 * @property integer $track_num
 * @property integer $year
 * @property integer $album_id
 * @property integer $media_id
 * @property string $name
 * @property string $time
 * @author kotov
 */
class Track extends ActiveRecord
{
    public static function tableName(): string
    {
        return '{{%tracks}}';
    }
    
    public static function create(
            $name,
            $trackNumber,
            $mediaId,
            $albumId
            
            ):self
    {
        $track  = new self();
        $track->name = $name;
        $track->track_num = $trackNumber;
        $track->media_id = $mediaId;
        $track->album_id = $albumId;
        return $track;
    }
    
    public function edit(
            $name,
            $trackNumber,
            $mediaId
            )
    {
        $this->name = $name;
        $this->track_num = $trackNumber;
        $this->media_id = $mediaId;
    }
    
}
