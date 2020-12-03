<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\core\repositories\Films;

use app\core\repositories\DataManipulationTrait;
use app\models\ActiveRecord\Film\Favorites;
/**
 * Description of FavoriteFilmsRepository
 *
 * @author kotov
 */
class FavoriteFilmsRepository
{
   use DataManipulationTrait;
   
   public function getField(int $filmId, int $userId): ?Favorites
   {
       return Favorites::find()
               ->andWhere(['user_id' => $userId])
               ->andWhere(['film_id' => $filmId])
               ->one();
   }
}
