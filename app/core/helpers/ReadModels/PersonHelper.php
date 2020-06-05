<?php

namespace app\core\helpers\ReadModels;

use app\core\repositories\PersonRepository;
use yii\helpers\ArrayHelper;

/**
 * Description of PersonHelper
 *
 * @author kotov
 */
class PersonHelper
{
    public static function getPersonList(): array
    {
        $personsArray = ArrayHelper::toArray(PersonRepository::getAll(),[
            Person::class => [
                'id',
                'name'
            ]
        ]);
        return ArrayHelper::map($personsArray, 'id', 'name');
    }
}
