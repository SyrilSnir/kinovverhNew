<?php

namespace app\models\ActiveRecord\Film;

use yii\db\ActiveRecord;
/**
 * Description of Category
 *
 * @property integer $id
 * @property string $name
 * @property string $code
 * 
 * @author kotov
 */
abstract class Category extends ActiveRecord
{
    abstract function getFilms();
}
