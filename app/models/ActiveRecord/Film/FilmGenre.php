<?php

namespace app\models\ActiveRecord\Film;

use yii\db\ActiveRecord;

/**
 * Связь фильма и жанра
 *
 * @property integer $film_id
 * @property integer $genre_id
 * @author kotov
 */
class FilmGenre extends ActiveRecord
{
    public static function tableName() 
    {
        return '{{%film_genre}}';
    }
    
    public static function create(
            int $filmId,
            int $genreId
        ):self
    {
        $model = new self();
        $model->film_id = $filmId;
        $model->genre_id = $genreId;
        return $model;
    }
}
