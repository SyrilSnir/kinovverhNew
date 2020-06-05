<?php

namespace app\core\services\operations\Person;

use app\models\ActiveRecord\Person\FilmPersonOccupation;
use app\models\ActiveRecord\Occupation;
/**
 * Description of FilmPersonOccupationService
 *
 * @author kotov
 */
class FilmPersonOccupationService
{
    public function clearActors(int $filmId)
    {
        $this->clearPersonsByOccupation($filmId, Occupation::KV_ACTOR);
    }
    
    public function clearEditors($filmId)
    {
        $this->clearPersonsByOccupation($filmId, Occupation::KV_EDITOR);
    }

    private function clearPersonsByOccupation(int $filmId, int $occupationId) 
    {
        FilmPersonOccupation::deleteAll([
            'film_id' => $filmId,
            'occupation_id' => $occupationId
        ]);
    }
}
