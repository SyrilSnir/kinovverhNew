<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\core\traits\Lists;

use app\models\ActiveRecord\Person;
use yii\helpers\ArrayHelper;

/**
 *
 * @author kotov
 */
trait PersonListTrait
{
    /**
     * 
     * @return array
     */
    public function getPersons():array
    {
        return ArrayHelper::map(Person::find()->orderBy('id')->asArray()->all(), 'id', 'name');
    }
}
