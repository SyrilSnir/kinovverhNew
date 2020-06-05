<?php

namespace app\models\ActiveRecord\Person;

use yii\db\ActiveRecord;
/**
 * Description of FilmPersonOccupation
 *
 * @author kotov
 */
class FilmPersonOccupation extends ActiveRecord
{
    public static function tableName(): string
    {
        return '{{%film_person_occupation}}';
    }        
    public static function create(
            int $filmId,
            int $personId,
            int $occupationId
        ):self         
    {
        $model = new self();
        $model->film_id = $filmId;
        $model->person_id = $personId;
        $model->occupation_id = $occupationId;
        return $model;
    }
}
