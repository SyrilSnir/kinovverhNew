<?php

namespace app\models\ActiveRecord\Film;

use yii\db\ActiveRecord;

/**
 * Description of Favorites
 *
 * @property integer $user_id
 * @property integer $film_id
 * @author kotov
 */
class Favorites extends ActiveRecord
{
    public static function tableName() 
    {
        return '{{%favorites_films}}';
    }
}
