<?php

namespace app\models\ActiveRecord\Audio;

use yii\db\ActiveRecord;

/**
 * Description of AlbumGenre
 *
 * @property integer $album_id
 * @property integer $genre_id
 * @author kotov
 */
class AlbumGenre extends ActiveRecord
{
    public static function tableName() 
    {
        return '{{%album_genre}}';
    }
    
    public static function create(
            int $albumId,
            int $genreId
        ):self
    {
        $model = new self();
        $model->album_id = $albumId;
        $model->genre_id = $genreId;
        return $model;
    }
}
